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
class logsModel extends ModelBase
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

	public function getLogsByWebsId($webId, $limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM logs where object ='webs' and objectid= :websId order by logsId DESC limit :limit");
		$consulta->bindParam(":websId", $webId);
		$consulta->bindParam(":limit", $limit);
		//			$consulta->bindParam(":customersId",$_SESSION['user']['customersId']);
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
	public function getChangelog($webId, $limit = 20)
	{
		$consulta = $this->db->prepare("SELECT * FROM logs where tag='changelog' and object ='webs' and objectid= :websId order by logsId DESC limit :limit");
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
	public function push($body, $tag, $object = 0, $id = 0, $usersId = 0)
	{
		$q  = $this->db->prepare("INSERT INTO logs (usersId,object,objectid,body,tag) VALUES (:uid,:o,:oi,:b,:tag) ON DUPLICATE KEY UPDATE    
counter = counter + 1");
		$q->bindParam(":uid", $usersId);
		$q->bindParam(":tag", $tag);
		$q->bindParam(":o", $object);
		$q->bindParam(":oi", $id);
		$q->bindParam(":b", $body);

		if ($q->execute()) return true;
		return false;
	}
}
