<?

/**
 * Package Name: Stripe Pad
 * File Description: Data Tracker Module
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

class datatrackerModel extends ModelBase
{
	private static $instance = null;

	public static function singleton()
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getThisWeek()
	{
		$c = $this->db->prepare("SELECT q,v FROM datatracker where datatracker.week = YEARWEEK(CURDATE())");
		$c->execute();
		return $this->transform($c->fetchAll());
	}

	private function transform($origin)
	{

		$result = array();
		foreach ($origin as $o) {
			$result[$o['q']] = $o['v'];
		}
		return $result;
	}

	public function get($key, $dateA = null, $dateB = null)
	{
		if (is_null($dateA)) $dateA = Date("Y-m-d");
		if (is_null($dateB)) $dateB = Date("Y-m-d");
		$consulta = $this->db->prepare("SELECT * FROM datatracker where q = :q and created BETWEEN :a AND :b");
		$consulta->bindParam(":q", $key);
		$consulta->bindParam(":a", $dateA);
		$consulta->bindParam(":b", $dateB);
		$consulta->execute();
		$aux2 = $consulta->fetchAll();

		return $aux2;
	}
	public function total($key, $dateA = null, $dateB = null)
	{
		if (is_null($dateA)) $dateA = Date("Y-m-d");
		if (is_null($dateB)) $dateB = Date("Y-m-d");

		$consulta = $this->db->prepare("SELECT sum(v) as total FROM datatracker where q = :q and created BETWEEN :a AND :b");
		$consulta->bindParam(":q", $key);
		$consulta->bindParam(":a", $dateA);
		$consulta->bindParam(":b", $dateB);
		$consulta->execute();
		$aux2 = $consulta->fetch();

		return $aux2['total'];
	}
	public function push($key, $value = 1)
	{
		//	$key = fingerprint($key);
		$consulta = $this->db->prepare("INSERT INTO datatracker (week,q,v) VALUES (YEARWEEK(CURDATE()),:q,:v) ON DUPLICATE KEY UPDATE v=v+:v2");
		$consulta->bindParam(":q", $key);
		$consulta->bindParam(":v", $value);
		$consulta->bindParam(":v2", $value);
		$consulta->execute();
	}
}
