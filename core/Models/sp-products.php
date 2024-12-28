<?

/**
 * Package Name: Stripe Pad
 * File Description: Products Model
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

/**
 * productsModel
 */
class productsModel extends ModelBase
{

	/**
	 * getById
	 *
	 * @param  int $rid
	 * @return void
	 */
	public function getById($rid)
	{
		return $this->getByIds(array($rid));
	}

	/**
	 * getByIds
	 *
	 * @param  Array $ids
	 * @return void
	 */
	public function getByIds($ids)
	{
		$ids = implode(",", $ids);
		$c = $this->db->prepare('SELECT * FROM products where productsId IN (:ids) ');
		$c->bindParam(':ids', $ids);
		$c->execute();
		$r = $c->fetchAll();
		return $r;
	}

	/**
	 * getAll
	 *
	 * @return Array
	 */
	public function getAll()
	{
		$consulta = $this->db->prepare("SELECT * FROM products order by title ASC");
		$consulta->execute();
		$aux2 = $consulta->fetchAll();
		return $aux2;
	}

	/**
	 * find
	 *
	 * @param  mixed $params
	 * @return Array
	 */
	public function find($params)
	{
		$consulta = $this->db->prepare("SELECT * FROM products where title like '%" . $params['query'] . "%' ");
		$consulta->execute();
		$aux2 = $consulta->fetchAll();
		return $aux2;
	}

	/**
	 * add
	 *
	 * @param  mixed $params
	 * @return void
	 */
	public function add($params)
	{
		$consulta = $this->db->prepare("INSERT INTO products (customersId,name,amount,stripe_payment_id,productsId) VALUES ('" . $params['customersId'] . "','" . $params['name'] . "','" . $params['amount'] . "','" . $params['stripe_payment_id'] . "','" . $params['productsId'] . "')");
		$consulta->execute();

		$stmt               = $this->db->query("SELECT LAST_INSERT_ID()");
		$last             = $stmt->fetch(PDO::FETCH_ASSOC);
		$last = $last['LAST_INSERT_ID()'];


		return $last;
	}

	/**
	 * edit
	 *
	 * @param  mixed $params
	 * @return void
	 */
	public function edit($params)
	{
		$consulta = $this->db->prepare("UPDATE products SET customersId = '" . $params['customersId'] . "',name = '" . $params['name'] . "',amount = '" . $params['amount'] . "',created = '" . $params['created'] . "',updated = '" . $params['updated'] . "'  where productsId='" . $params['id'] . "'");
		$consulta->execute();
		if ($consulta->rowCount() > 0) return true;
		else return false;
	}

	/**
	 * delete
	 *
	 * @param  mixed $params
	 * @return void
	 */
	public function delete($id)
	{
		$consulta = $this->db->prepare("DELETE FROM products where productsId='" . $id . "'");
		$consulta->execute();
		if ($consulta->rowCount() > 0) return true;
		else return false;
	}
}
