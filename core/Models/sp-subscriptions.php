<?

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


  public function getByUsersId($customersId)
  {

    $q  = $this->db->prepare("SELECT * FROM subscriptions JOIN products on (subscriptions.productsId = products.productsId) where customersId = :cid order by subscriptions.created DESC");
    $q->bindParam(":cid", $customersId);
    $q->execute();
    return $q->fetchAll();
  }

  public function create($data)
  {

    $q = $this->db->prepare("INSERT INTO subscriptions (customersId,productsId) VALUES (:cid,:pid)");
    $q->bindParam(":cid", $data['customersId']);
    $q->bindParam(":pid", $data['productsId']);
    #  $q->bindParam(":invid", $data['invoicesId']);

    $q->execute();

    return $this->getLastId();
  }

  public function activate($subscriptionsId) {}
  public function cancel($subscriptionsId) {}

  public function renew($subscriptionsId) {}
}
