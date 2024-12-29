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


	public function getAll($limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM logs where tag='error' and object ='webs' order by logsId DESC limit :limit ");

		$consulta->bindParam(":limit", $limit);
		$consulta->execute();
		return $consulta->fetchAll();
	}

	public function getLogsByTag($usersId, $tag, $limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM logs where tag=:tag and usersId = :usersId order by updated DESC limit :limit ");
		$consulta->bindParam(":usersId", $usersId);
		$consulta->bindParam(":tag", $tag);
		$consulta->bindParam(":limit", $limit);
		$consulta->execute();
		return $consulta->fetchAll();
	}

	public function getLast20ByTag($tag, $limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM logs where tag=:tag  order by updated DESC limit :limit ");
		$consulta->bindParam(":tag", $tag);
		$consulta->bindParam(":limit", $limit);
		$consulta->execute();
		return $consulta->fetchAll();
	}


	public function getAllErrors($webId, $limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM logs where tag='error' and object ='webs' and objectid= :websId order by logsId DESC limit :limit ");
		$consulta->bindParam(":websId", $webId);
		$consulta->bindParam(":limit", $limit);
		//			$consulta->bindParam(":customersId",$_SESSION['user']['customersId']);
		$consulta->execute();
		return $consulta->fetchAll();
	}


	public function getFeed($limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM logs where tag='error' order by logsId DESC limit :limit");

		$consulta->bindParam(":limit", $limit);
		//			$consulta->bindParam(":customersId",$_SESSION['user']['customersId']);
		$consulta->execute();
		return $consulta->fetchAll();
	}
	public function push($label, $tag, $usersId = 0)
	{
		$hash = $tag . "-" . $usersId . "-" . fingerprint($label);

		$q  = $this->db->prepare("INSERT INTO logs (hash,week,usersId,body,tag) VALUES (:hash,YEARWEEK(CURDATE(),:uid,:b,:tag) ON DUPLICATE KEY UPDATE    
total =total + 1");
		$q->bindParam(":uid", $usersId);
		$q->bindParam(":tag", $tag);
		$q->bindParam(":hash", $hash);
		$q->bindParam(":b", $label);

		if ($q->execute()) return true;
		return false;
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
		$q = $this->db->prepare("SELECT * FROM counters where usersId = :id");
		$q->bindParam(":id", $_SESSION['user']['usersId']);
		$q->execute();

		return $q->fetchAll();
	}

	public function counters_getByGroup($groupsId, $period)
	{

		$datatracker = new datatrackerModel();

		$q = $this->db->prepare("SELECT * FROM counters where groupsId = :id and usersId = :usersId");
		$q->bindParam(":id", $groupsId);
		$q->bindParam(":usersId", $_SESSION['user']['usersId']);
		$q->execute();

		$counters = $q->fetchAll();

		if ($period != "total") {
			for ($i = 0; $i < count($counters); $i++) {
				$counters[$i]['total'] = $datatracker->getByPeriod($counters[$i]['countersId'], $period);
			}
		}

		return $counters;
	}

	public function counters_get($id)
	{



		$q = $this->db->prepare("SELECT * FROM counters where countersId = :id and usersId = :usersId limit 1");
		$q->bindParam(":id", $id);
		$q->bindParam(":usersId", $_SESSION['user']['usersId']);
		$q->execute();

		$counter = $q->fetch();

		return $counter;
	}
	public function getWithHistory($id)
	{
		$dt = new datatrackerModel();

		$counter = $this->get($id);
		$counter['history'] = $dt->getHistory($id, 'week');

		return $counter;
	}

	public function create($label, $group = 0)
	{

		// Get last id to generate hash
		$q = $this->db->prepare("SELECT countersId from counters order by countersId DESC");
		$q->execute();
		$c = $q->fetch();

		// hash
		$hash = (1 + $c['countersId']) . "-" . fingerprint($label);

		// Save new counter in db
		$q = $this->db->prepare("INSERT INTO counters (usersId, groupsId, label, hash ) VALUES (:user,:group,:label,:hash)");
		$q->bindParam(":user", $_SESSION['user']['usersId']);
		$q->bindParam(":group", $group);
		$q->bindParam(":hash", $hash);
		$q->bindParam(":label", $label);
		$q->execute();

		// Return counter array
		if ($q->rowCount() > 0) {
			$q = $this->db->prepare("SELECT * from counters where countersId = LAST_INSERT_ID()");
			$q->execute();
			return $q->fetch();
		} else {
			die("Could not create counter");
			return array();
		}
	}

	public function fastcount($id, $value)
	{

		assert(!empty($id));
		assert($value > 0);

		$value = intval($value);

		$q = $this->db->prepare("UPDATE counters set total = total + :value where countersId = :id and usersId = :usersId");
		$q->bindParam(":id", $id);
		$q->bindParam(":value", $value);
		$consulta->bindParam(":usersId", $_SESSION['user']['usersId']);
		$q->execute();

		// Data point
		$consulta = $this->db->prepare("INSERT INTO datatracker (week,month,customersId,usersId,countersId,counter)
			VALUES  (YEARWEEK(CURDATE()),extract(YEAR_MONTH FROM CURDATE()), :customersId,:usersId, :kpi, :counter)");

		$consulta->bindParam(":customersId", $_SESSION['user']['customersId']);
		$consulta->bindParam(":usersId", $_SESSION['user']['usersId']);
		$consulta->bindParam(":kpi", $id);
		$consulta->bindParam(":counter", $value);
		if ($consulta->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function count($id, $value)
	{

		assert(!empty($id));
		$value = intval($value);
		assert(!empty($value));

		$q = $this->db->prepare("UPDATE counters set total = total + :value where countersId = :id");
		$q->bindParam(":id", $id);
		$q->bindParam(":value", $value);
		$q->execute();

		// Data point
		$consulta = $this->db->prepare("INSERT INTO datatracker (week,month,customersId,usersId,countersId,counter)
			VALUES  (YEARWEEK(CURDATE()),extract(YEAR_MONTH FROM CURDATE()), :customersId,:usersId, :kpi, :counter)");

		//	$consulta->bindParam(":hash",$hash);
		$consulta->bindParam(":customersId", $_SESSION['user']['customersId']);
		$consulta->bindParam(":usersId", $_SESSION['user']['usersId']);
		$consulta->bindParam(":kpi", $id);
		$consulta->bindParam(":counter", $value);
		$consulta->execute();

		if ($consulta->rowCount() > 0) {
			$q = $this->db->prepare("SELECT * from datatracker where id = LAST_INSERT_ID()");
			$q->execute();
			return $q->fetch();
		} else {
			return array();
		}
	}

	public function counters_update($id, $label, $group, $addToCount = 0)
	{

		$q = $this->db->prepare("UPDATE counters set label = :label, groupsId = :group where countersId = :id");
		$q->bindParam(":label", $label);
		$q->bindParam(":group", $group);
		$q->bindParam(":id", $id);
		$q->execute();

		if (intval($addToCount) > 0) {
			$this->count($id, $addToCount);
		}

		return $this->get($id);
	}

	public function counters_delete($id)
	{

		$q = $this->db->prepare("DELETE FROM counters where countersId = :id and usersId = :usersId");
		$q->bindParam(":id", $id);
		$q->bindParam(":usersId", $_SESSION['user']['usersId']);
		if ($q->execute()) {

			// Delete data points
			$q = $this->db->prepare("DELETE FROM datatracker where countersId = :id");
			$q->bindParam(":id", $id);
			$q->execute();
		}
		// Empty array()
		return array();
	}

	// GROUP
	public function groups_all()
	{
		$q = $this->db->prepare("SELECT * FROM groups where usersId = :id");
		$q->bindParam(":id", $_SESSION['user']['usersId']);
		$q->execute();

		return $q->fetchAll();
	}
	public function groups_get($groupsId, $period = "total")
	{

		$counters = new counterModel();


		$q = $this->db->prepare("SELECT * FROM groups where groupsId = :id and usersId = :usersId limit 1");
		$q->bindParam(":id", $id);
		$q->bindParam(":usersId", $_SESSION['user']['usersId']);
		$q->execute();
		$group = $q->fetch(true);

		$group['counters'] = $this->counters_getByGroup($groupsId, $period); //$q->fetchAll();

		return $group;
	}

	public function groups_create($user, $label)
	{
		if (empty($label)) return array();

		$q = $this->db->prepare("INSERT INTO groups (usersId, label) VALUES (:user, :label)");
		$q->bindParam(":label", $label);
		$q->bindParam(":user", $user);

		$q->execute();

		$q = $this->db->prepare("SELECT * from groups where groupsId = LAST_INSERT_ID()");
		$q->execute();

		$group = $q->fetch();


		// $hash = $user."-".$group['groupsId']."-".fingerprint($label);

		// $q = $this->db->prepare("UPDATE groups set hash = :hash where groupsId = :id");
		// $q->bindParam(":id",$group['id']);
		// $q->bindParam(":hash",$hash);
		// $q->execute();

		// $group['hash'] = $hash;

		return $group;
	}

	public function groups_update($id, $label, $order)
	{
		$q = $this->db->prepare("INSERT INTO groups (usersId, label) VALUES (:user, :label)");
		$q->bindParam(":label", $label);
		$q->bindParam(":user", $user);
		$q->execute();

		return $this->get($id);
	}

	public function groups_delete($id)
	{
		$q = $this->db->prepare("DELETE FROM groups where id = :id");
		$q->bindParam(":id", $id);
		$q->execute();
	}
}
