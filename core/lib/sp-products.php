<?php

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
	var $log;
	var $table = 'products';

	public function __construct()
	{
		parent::__construct($this->table);
		$this->log = log::singleton();
	}
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
		if (empty($ids)) {
			return [];
		}

		$placeholders = implode(',', array_fill(0, count($ids), '?'));
		$c = $this->db->prepare("SELECT * FROM products WHERE productsId IN ($placeholders)");
		$c->execute(array_values($ids));
		return $c->fetchAll();
	}

	/**
	 * getAll
	 *
	 * @return Array
	 */
	public function getAll()
	{
		$consulta = $this->db->prepare("SELECT * FROM products WHERE visible > 0 ORDER BY name ASC");
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
		$query = isset($params['query']) ? '%' . $params['query'] . '%' : '%';
		$consulta = $this->db->prepare("SELECT * FROM products WHERE name LIKE :query");
		$consulta->bindParam(':query', $query, PDO::PARAM_STR);
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
		$sql = "INSERT INTO products (customersId, name, amount, stripe_payment_id, productsId) 
				VALUES (:customersId, :name, :amount, :stripe_payment_id, :productsId)";
        $consulta = $this->db->prepare($sql);
		$consulta->bindParam(':customersId', $params['customersId']);
		$consulta->bindParam(':name', $params['name']);
		$consulta->bindParam(':amount', $params['amount']);
		$consulta->bindParam(':stripe_payment_id', $params['stripe_payment_id']);
		$consulta->bindParam(':productsId', $params['productsId']);
		$consulta->execute();

		return (int)$this->db->lastInsertId();
	}

	/**
	 * edit
	 *
	 * @param  mixed $params
	 * @return void
	 */
	public function edit($params)
	{
		$sql = "UPDATE products 
				SET customersId = :customersId,
					name = :name,
					amount = :amount,
					created = :created,
					updated = :updated
				WHERE productsId = :id";
		$consulta = $this->db->prepare($sql);
		$consulta->bindParam(':customersId', $params['customersId']);
		$consulta->bindParam(':name', $params['name']);
		$consulta->bindParam(':amount', $params['amount']);
		$consulta->bindParam(':created', $params['created']);
		$consulta->bindParam(':updated', $params['updated']);
		$consulta->bindParam(':id', $params['id']);
		$consulta->execute();
		return $consulta->rowCount() > 0;
	}

	/**
	 * delete
	 *
	 * @param  mixed $params
	 * @return void
	 */
	public function delete($id)
	{
		$consulta = $this->db->prepare("DELETE FROM products WHERE productsId = :id");
		$consulta->bindParam(':id', $id);
		$consulta->execute();
		return $consulta->rowCount() > 0;
	}
}
