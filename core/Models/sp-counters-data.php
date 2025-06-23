<?



class datatrackerModel extends ModelBase
{
		public function get($usersId,$period){

			$q = $this->db->prepare("SELECT countersId, label FROM counters where usersId = :usersId");
			$q->bindParam(":usersId",$usersId);
			$q->execute();
			$counters = $q->fetchAll();

			$out = array();

			foreach($counters as $c){
				
				$history = $this->getHistory($c['countersId'],$period);
				$c['history'] = $history;
				$c['last'] = $history[count($history)-1];

				$out[] = $c;

			}


			return $out;
	    	
		}

		public function getByPeriod($countersId, $period){

			$sql = "";
			if ($period == "month"){
				$sql = "SELECT SUM(counter) as total from datatracker WHERE month(created) = month(CURDATE()) and countersId = :countersId";	
			}elseif ($period == "week"){
				$sql = "SELECT SUM(counter) AS total FROM datatracker WHERE week = YEARWEEK(CURDATE()) AND countersId = :countersId";
			}elseif ($period == "year"){
				$sql = "SELECT SUM(counter) AS total FROM datatracker WHERE YEAR(created) = YEAR(CURDATE()) AND countersId = :countersId";
			}
			
			$q = $this->db->prepare($sql);
			$q->bindParam(":countersId",$countersId);
			$q->execute();
			$c = $q->fetch();
			return intval($c['total']);
		}
		
		public function getHistory($countersId, $period){

			if (!isset($period) or empty($period)) die("Missing period");
			
			$query = null;
			
			switch ($period) {
			    case 'week':
			      $query = "SELECT SUM(counter) AS counter, week as period FROM datatracker WHERE countersId = :countersId GROUP BY week ORDER BY week DESC;";
			      break;
			    case 'month':
			      $query = "SELECT SUM(counter) AS counter, month as period FROM datatracker WHERE countersId = :countersId GROUP BY month ORDER BY month DESC;";
			      break;
			    case 'year':
			      $query = "SELECT SUM(counter) AS counter, year as period FROM datatracker WHERE countersId = :countersId AND YEAR(created) = extract(YEAR FROM created) GROUP BY year ORDER BY year DESC;";
			      break;
			    case 'total':
			      $query = "SELECT SUM(counter) AS counter, 'total' as period FROM datatracker WHERE countersId = :countersId";
			      break;
			    default:
			      die("Invalid period");
			}
			
			$consulta = $this->db->prepare($query);
			$consulta->bindParam(":countersId", $countersId);									
			$consulta->execute();
			$rows = $consulta->fetchAll();			
			
			return $rows; //array_column($rows, 'counter');
			

		}

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
		
		public function updateLabel($usersId, $id, $new_label){
			
            if (empty($new_label)) return;
			$consulta = $this->db->prepare("SELECT kpi FROM datatracker where id =:id and usersId = :usersId limit 1");
			$consulta->bindParam(":usersId", $usersId);							
			$consulta->bindParam(":id",$id);		
			$consulta->execute();
			
			$old = $consulta->fetch();
			
			$consulta = $this->db->prepare("UPDATE datatracker set kpi = :new_label where usersId = :usersId and kpi = :kpi");
			$consulta->bindParam(":usersId", $usersId);							
			$consulta->bindParam(":kpi",$old['kpi']);		
			$consulta->bindParam(":new_label", $new_label);									
			$consulta->execute();
		
		//	$rows = $consulta->fetchAll();			
			
		}
		public function	remove($usersId, $id){
			
			$consulta = $this->db->prepare("SELECT kpi FROM datatracker where id =:id and usersId = :usersId limit 1");
			$consulta->bindParam(":usersId", $usersId);							
			$consulta->bindParam(":id",$id);		
			$consulta->execute();
			
			$old = $consulta->fetch();
			
			$consulta = $this->db->prepare("DELETE FROM datatracker where kpi = :kpi and usersId = :usersId ");
			$consulta->bindParam(":usersId", $usersId);									
			$consulta->bindParam(":kpi", $old['kpi']);									
			$consulta->execute();
		}
		private function fingerprint($result){
					
			// Remove all accents. Compatibility for Spanish strings
			
			// Every char to lowercase
			$result = strtolower($result);
			// Remove all chars that are not letters
			$result = preg_replace('/[^ \w]+/', '', $result);
			$words = explode(" ",$result);
			// remove duplicates
			$words = array_unique($words);
			// the order of terms is important
			sort($words);
			// "-" to separate terms, but you can get rid of this
			return implode("-",$words);

		}
}
