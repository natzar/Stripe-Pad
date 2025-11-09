<?php

/**
 * Package Name: Stripe Pad
 * File Description: Logs Model
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This file is part of Stripe Pad.
 *
 *	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */
class log extends ModelBase
{
	private static $instance = null;

	public function __construct()
	{
		parent::__construct();
	}
	public static function singleton()
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * push
	 * Store a new message in log table
	 * @param  mixed $label
	 * @param  mixed $tag
	 * @param  mixed $body
	 * @param  mixed $usersId
	 * @return void
	 */
	public function push($label, $tag = "system", $body = "", $usersId = 0)
	{

		switch ($tag):
			case 'system':
			case 'system.error':
				self::system($label . " " . $body);
				break;
			default:
				$hash = $tag . "-"  . fingerprint($label . "-" . $body);
				$hash = substr($hash, 0, 200);

				$body = substr($body, 0, 255);
				$month = (int)date('Ym');
				$week = (int)date('oW');

				if (APP_STORAGE === 'mysql') {
					$sql = "INSERT INTO logs (hash, month, week, usersId, label, tag, body)
							VALUES (:hash, :month, :week, :uid, :label, :tag, :body)
							ON DUPLICATE KEY UPDATE total = total + 1, updated = NOW()";
				} else {
					$sql = "INSERT INTO logs (hash, month, week, usersId, label, tag, body, created, updated)
							VALUES (:hash, :month, :week, :uid, :label, :tag, :body, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
							ON CONFLICT(hash) DO UPDATE SET total = total + 1, updated = CURRENT_TIMESTAMP";
				}

				$q  = $this->db->prepare($sql);
				$q->bindParam(":uid", $usersId);
				$q->bindParam(":tag", $tag);
				$q->bindParam(":hash", $hash);
				$q->bindParam(":label", $label);
				$q->bindParam(":body", $body);
				$q->bindParam(":month", $month, PDO::PARAM_INT);
				$q->bindParam(":week", $week, PDO::PARAM_INT);
				$q->execute();
				//	self::system($tag . " - " . $label . " " . $body);

				break;
		endswitch;
	}


	public function getAll($limit = 20)
	{

		// SUPERADMIN only
		$consulta = $this->db->prepare("SELECT * FROM logs  order by updated DESC limit :limit ");

		$consulta->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
		$consulta->execute();
		return $consulta->fetchAll();
	}

	public function getLogsByTag($tag, $usersId = -1, $limit = 20)
	{
		$consulta = null;
		if ($usersId > -1) {
			$consulta = $this->db->prepare("SELECT * FROM logs where tag=:tag and usersId = :usersId order by updated DESC limit :limit ");
			$consulta->bindParam(":usersId", $usersId);
		} else {
			$consulta = $this->db->prepare("SELECT * FROM logs where tag=:tag  order by updated DESC limit :limit ");
		}
		$consulta->bindParam(":tag", $tag);
		$consulta->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
		$consulta->execute();
		return $consulta->fetchAll();
	}


	/**
	 * get_counters
	 *
	 * @param  mixed $period
	 * @param  mixed $dateA
	 * @param  mixed $dateB
	 * @return void
	 */
	public function get_counters($period = null, $dateA = null, $dateB = null)
	{
		if (is_null($dateA)) $dateA = Date("Y-m-d");
		if (is_null($dateB)) $dateB = Date("Y-m-d");
		$consulta = $this->db->prepare("SELECT distinct label,sum(total) as total FROM logs where tag='counter' "); // and created BETWEEN :a AND :b
		//$consulta->bindParam(":q", $key);
		//$consulta->bindParam(":a", $dateA);
		//$consulta->bindParam(":b", $dateB);
		$consulta->execute();
		$result = array();
		$origin = $consulta->fetchAll();
		return $origin;
		// foreach ($origin as $o) {
		// 	$result[$o['q']] = $o['v'];
		// }
		// return $result;
		// return $aux2;
	}
	public function calculate_total($key, $dateA = null, $dateB = null)
	{
		if (is_null($dateA)) $dateA = Date("Y-m-d");
		if (is_null($dateB)) $dateB = Date("Y-m-d");

		$consulta = $this->db->prepare("SELECT sum(v) as total FROM log where q = :q and created BETWEEN :a AND :b");
		$consulta->bindParam(":q", $key);
		$consulta->bindParam(":a", $dateA);
		$consulta->bindParam(":b", $dateB);
		$consulta->execute();
		$aux2 = $consulta->fetch();

		return $aux2['total'];
	}

	/**
	 * get_online_visitors_count
	 *
	 * @return int
	 */
	public function get_online_visitors_count()
	{
		$traffic = $this->getTrafficSummaryFromFile(1, 10);
		return $traffic['online_visitors'];
	}

	/**
	 * Parse logs/traffic.log and return aggregated stats.
	 */
	public function getTrafficSummaryFromFile(int $days = 30, int $minutesForOnline = 10): array
	{
		$summary = [
			'online_visitors' => 0,
			'daily_counts' => [],
			'chart_labels' => [],
			'chart_values' => [],
			'total_pageviews' => 0,
		];

		$path = ROOT_PATH . 'logs/traffic.log';
		if (!is_readable($path)) {
			return $summary;
		}

		$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		if ($lines === false) {
			return $summary;
		}

		$dailyCounts = [];
		$recentIps = [];
		$cutoff = time() - ($minutesForOnline * 60);

		foreach ($lines as $line) {
			$line = ltrim($line);
			if ('' === $line) {
				continue;
			}

			// Remove optional leading "#" used by some log entries
			if ($line[0] === '#') {
				$line = ltrim($line, "#");
			}

			if (!preg_match('/\[(?P<timestamp>[^]]+)\]\s+\[(?P<type>[^]]+)\]\s+(?P<payload>.+)$/', $line, $matches)) {
				continue;
			}

			$ts = strtotime($matches['timestamp']);
			if ($ts === false) {
				continue;
			}

			$payload = trim($matches['payload']);
			$ip = null;
			$url = $payload;
			$separator = strrpos($payload, '-');
			if ($separator !== false) {
				$url = trim(substr($payload, 0, $separator));
				$ip = trim(substr($payload, $separator + 1));
			}

			$dateKey = date('Y-m-d', $ts);
			if (!isset($dailyCounts[$dateKey])) {
				$dailyCounts[$dateKey] = 0;
			}
			$dailyCounts[$dateKey]++;

			if ($ip && $ts >= $cutoff) {
				$recentIps[$ip] = true;
			}
		}

		ksort($dailyCounts);
		if ($days > 0 && count($dailyCounts) > $days) {
			$dailyCounts = array_slice($dailyCounts, -$days, $days, true);
		}

		$summary['daily_counts'] = $dailyCounts;
		$summary['chart_labels'] = array_keys($dailyCounts);
		$summary['chart_values'] = array_values($dailyCounts);
		$summary['total_pageviews'] = array_sum($dailyCounts);
		$summary['online_visitors'] = count($recentIps);

		return $summary;
	}

	public static function write(string $filename, string $message)
	{
		$logDir = ROOT_PATH . "logs/";
		if (!is_dir($logDir)) mkdir($logDir, 0777, true);

		$path = $logDir . $filename;
		$line = "[" . date("Y-m-d H:i:s") . "] " . $message . PHP_EOL;
		file_put_contents($path, $line, FILE_APPEND);
	}

	public static function system(string $message)
	{
		self::write('system.log', $message);
	}
	public static function crons(string $message)
	{
		self::write('crons.log', $message);
	}
	public static function openai(string $message)
	{
		$message = "===================================================\n" . $message;
		self::write('openai.log', $message);
	}
	public static function tool_calls(int $emailId, string $message)
	{
		self::write("tool_calls.log", $message);
		self::write("tool_calls_{$emailId}.log", $message);
	}
	public static function email(int $emailId, string $message)
	{
		self::write("email_{$emailId}.log", $message);
	}
	public static function traffic(string $message)
	{
		self::write("traffic.log", $message);
	}
}
