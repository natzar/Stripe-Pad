<?

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

	public static function singleton()
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * push
	 *
	 * @param  mixed $label
	 * @param  mixed $tag
	 * @param  mixed $usersId
	 * @return void
	 */
	public function push($label, $tag, $usersId = 0)
	{
		$hash = $tag . "-"  . fingerprint($label);

		$q  = $this->db->prepare("INSERT INTO log (hash,month,week,usersId,label,tag) VALUES (:hash,extract(YEAR_MONTH FROM CURDATE()),YEARWEEK(CURDATE()),:uid,:b,:tag) ON DUPLICATE KEY UPDATE    
total =total + 1");
		$q->bindParam(":uid", $usersId);
		$q->bindParam(":tag", $tag);
		$q->bindParam(":hash", $hash);
		$q->bindParam(":b", $label);
		$q->execute();
	}


	public function getAll($limit = 20)
	{

		// SUPERADMIN only
		$consulta = $this->db->prepare("SELECT * FROM log  order by updated DESC limit :limit ");

		$consulta->bindParam(":limit", $limit);
		$consulta->execute();
		return $consulta->fetchAll();
	}

	public function getLogsByTag($usersId, $tag, $limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM log where tag=:tag and usersId = :usersId order by updated DESC limit :limit ");
		$consulta->bindParam(":usersId", $usersId);
		$consulta->bindParam(":tag", $tag);
		$consulta->bindParam(":limit", $limit);
		$consulta->execute();
		return $consulta->fetchAll();
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


	// COUNTER

	public function counters_findIdByLabel($label)
	{
		$label = trim($label);

		if (empty($label)) return -1;

		$q = $this->db->prepare("SELECT countersId FROM counters where label = :label and usersId = :usersId limit 1");
		$q->bindParam(":label", $label);
		$q->bindParam(":usersId", $_SESSION['user']['usersId']);
		$q->execute();
		$counter = $q->fetch();

		if (isset($counter['countersId'])) {
			return $counter['countersId'];
		}

		return -1;
	}

	public function counters_all()
	{
		$q = $this->db->prepare("SELECT * FROM log where usersId = :id");
		$q->bindParam(":id", $_SESSION['user']['usersId']);
		$q->execute();

		return $q->fetchAll();
	}
}
