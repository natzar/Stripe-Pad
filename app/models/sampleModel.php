<?

/**
 * Package Name: Stripe Pad 
 * File Description: This file is a sample model accessing db 
 * 
 * @author John Doe <john.doe@example.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/johndoe/my-awesome-php-package
 * 
 */

/**
 * [Description sampleModel]
 */
class sampleModel extends ModelBase
{

	public function all()
	{
		$q = $this->db->prepare("SELECT * FROM groups where usersId = :id");
		$q->bindParam(":id", $_SESSION['user']['usersId']);
		$q->execute();

		return $q->fetchAll();
	}

	public function delete($id)
	{
		$q = $this->db->prepare("DELETE FROM groups where id = :id");
		$q->bindParam(":id", $id);
		$q->execute();
	}
}
