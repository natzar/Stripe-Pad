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

				$q  = $this->db->prepare("INSERT INTO logs (hash,month,week,usersId,label,tag,body) VALUES (:hash,extract(YEAR_MONTH FROM CURDATE()),YEARWEEK(CURDATE()),:uid,:label,:tag,:body) ON DUPLICATE KEY UPDATE    
	total =total + 1");
				$q->bindParam(":uid", $usersId);
				$q->bindParam(":tag", $tag);
				$q->bindParam(":hash", $hash);
				$q->bindParam(":label", $label);
				$q->bindParam(":body", $body);
				$q->execute();
				//	self::system($tag . " - " . $label . " " . $body);

				break;
		endswitch;
	}


	public function getAll($limit = 20)
	{

		// SUPERADMIN only
		$consulta = $this->db->prepare("SELECT * FROM logs  order by updated DESC limit :limit ");

		$consulta->bindParam(":limit", $limit);
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
		$consulta->bindParam(":limit", $limit);
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
		return 0;

		$q = $this->db->prepare("SELECT COUNT(DISTINCT body) AS unique_pageviews
			FROM logs
			WHERE tag = 'pageview'
  			AND updated >= NOW() - INTERVAL 10 MINUTE;");
		$q->execute();
		$r = $q->fetch();
		return $r['unique_pageviews'];
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
