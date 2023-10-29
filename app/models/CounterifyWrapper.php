<?
/**
 * Package Name: Stripe Pad <> Counterify
 * File Description: This file handles connection with counterify.com server. Counterify is a service to track and count everything from anything.
 * 
 * @author John Doe <john.doe@example.com>
 * @version 1.0.0
 * @package Counterify PHP SDK
 * @license GPL3
 * @link https://github.com/johndoe/my-awesome-php-package
 * 
 */

class Counterify {

		public function push( $usersId, $kpi, $value){

			$consulta = $this->db->prepare("
				INSERT INTO datatracker (hash,week,month,customersId,usersId,kpi,counter)
				VALUES  (:hash,YEARWEEK(CURDATE()),extract(YEAR_MONTH FROM CURDATE()), :customersId,:usersId, :kpi, :counter)");
			
			$hash = $this->fingerprint($kpi);
			$consulta->bindParam(":hash",$hash);
			$consulta->bindParam(":customersId",$_SESSION['user']['customersId']);
			$consulta->bindParam(":usersId",$_SESSION['user']['usersId']);
			$consulta->bindParam(":kpi",$kpi);
			$consulta->bindParam(":counter",$value);
			$consulta->execute();
			
			if ($consulta->rowCount() > 0){	
				$q = $this->db->prepare("SELECT * from datatracker where id = LAST_INSERT_ID()");
				$q->execute();
				return $q->fetch();
			}else {
				return array();
			}
		}
		
	
}
