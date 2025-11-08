<?php

/**
 * Package Name: Stripe Pad
 * File Description: Subscriptions Model
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

class subscriptionsModel extends ModelBase
{
  var $table = 'subscriptions';

  public function __construct()
  {
    parent::__construct($this->table);
  }

  /**
   * getByUsersId
   *
   * @param  mixed $usersId
   * @return void
   */
  public function getByUsersId($usersId)
  {

    $q  = $this->db->prepare("SELECT * FROM subscriptions JOIN products on (subscriptions.productsId = products.productsId) where usersId = :cid order by subscriptions.created DESC");
    $q->bindParam(":cid", $usersId);
    $q->execute();
    return $q->fetchAll();
  }

  /**
   * create
   *
   * @param  mixed $usersId
   * @param  mixed $productsId
   * @return void
   */
  public function create($user, $productsId)
  {

    log::system("New subscription: " . $user['email'] . " - " . $productsId, 'system');

    $q = $this->db->prepare("INSERT INTO subscriptions (usersId,productsId) VALUES (:cid,:pid)");
    $q->bindParam(":cid", $user['usersId']);
    $q->bindParam(":pid", $productsId);
    #  $q->bindParam(":invid", $data['invoicesId']);

    $q->execute();
    $data = array();

    $mails = new mailsModel();

    // $mails->internal("Nuevo Plan! y nuevo usuario en area de clientes", $this->customer['email']);
    // //$this->datatracker->push("areaclientes-send-bienvenida-plan");
    $subject = "Welcome on board!";
    //$mails->sendTemplate('subscription_created', $data, $user['email'], $subject);

    return $this->get_by_id($this->getLastId());
  }

  /**
   * @param mixed $subscriptionsId
   * 
   * @return [type]
   */
  public function archive($subscriptionsId) {}

  /**
   * update
   *
   * @param  mixed $subscriptionsId
   * @return void
   */
  public function update($subscriptionsId) {}
}
