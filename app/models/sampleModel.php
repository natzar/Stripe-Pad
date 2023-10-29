<?

/**
 * Package Name: Stripe Pad 
 * File Description: This file is a sample, functions connectiong to database (models)
 * 
 * @author John Doe <john.doe@example.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/johndoe/my-awesome-php-package
 * 
 */

// Remaining PHP code...

class sampleModel extends ModelBase {

	public function all(){
		$q = $this->db->prepare("SELECT * FROM groups where usersId = :id");
		$q->bindParam(":id",$_SESSION['user']['usersId']);
		$q->execute();
		
		return $q->fetchAll();
	}
	public function get($groupsId,$period = "total"){
		
		$counters = new counterModel();


		$q = $this->db->prepare("SELECT * FROM groups where groupsId = :id and usersId = :usersId limit 1");
		$q->bindParam(":id",$id);
		$q->bindParam(":usersId",$_SESSION['user']['usersId']);
		$q->execute();
		$group = $q->fetch(true);

		$group['counters'] = $counters->getByGroup($groupsId, $period); //$q->fetchAll();

		return $group;
	}

	public function create($user, $label){
		
		$q = $this->db->prepare("INSERT INTO groups (usersId, label) VALUES (:user, :label)");
		$q->bindParam(":label",$label);
		$q->bindParam(":user",$user);
		
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

	public function update($id, $label, $order){
		$q = $this->db->prepare("INSERT INTO groups (usersId, label) VALUES (:user, :label)");
		$q->bindParam(":label",$label);
		$q->bindParam(":user",$user);		
		$q->execute();

		return $this->get($id);

	}

	public function delete($id){
		$q = $this->db->prepare("DELETE FROM groups where id = :id");
		$q->bindParam(":id",$id);		
		$q->execute();
	}

}