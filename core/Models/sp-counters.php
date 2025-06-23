<?

class counterModel extends ModelBase
{	

		public function findIdByLabel($label){

			$q = $this->db->prepare("SELECT countersId FROM counters where label = :label and usersId = :usersId limit 1");
			$q->bindParam(":label",$label);
			$q->bindParam(":usersId",$_SESSION['user']['usersId']);
			$q->execute();
			$counter = $q->fetch();

			if (isset($counter['countersId'])){
 				return $counter['countersId'];
			}

			return -1;			
			
		}

		public function all(){
			$q = $this->db->prepare("SELECT * FROM counters where usersId = :id");
			$q->bindParam(":id",$_SESSION['user']['usersId']);
			$q->execute();
		
			return $q->fetchAll();
		}

		public function getByGroup($groupsId, $period){

			$datatracker = new datatrackerModel();
			
			$q = $this->db->prepare("SELECT * FROM counters where groupsId = :id and usersId = :usersId");
			$q->bindParam(":id",$groupsId);
			$q->bindParam(":usersId",$_SESSION['user']['usersId']);
			$q->execute();

			$counters = $q->fetchAll();

			if ($period != "total"){
				for($i=0;$i<count($counters);$i++){				
					$counters[$i]['total'] = $datatracker->getByPeriod($counters[$i]['countersId'], $period);
				}
			}
			
			return $counters;
		}

		public function get($id){



			$q = $this->db->prepare("SELECT * FROM counters where countersId = :id and usersId = :usersId limit 1");
			$q->bindParam(":id",$id);
			$q->bindParam(":usersId",$_SESSION['user']['usersId']);
			$q->execute();

			$counter = $q->fetch();

			return $counter;

		}
		public function getWithHistory($id){
			$dt = new datatrackerModel();

			$counter = $this->get($id);
			$counter['history'] = $dt->getHistory($id,'week');

			return $counter;

		}

		public function create($label, $group = 0){			

			// Get last id to generate hash
			$q = $this->db->prepare("SELECT countersId from counters order by countersId DESC");
			$q->execute();
			$c = $q->fetch();

			// hash
			$hash = (1+$c['countersId'])."-".fingerprint($label);
			
			// Save new counter in db
			$q = $this->db->prepare("INSERT INTO counters (usersId, groupsId, label, hash ) VALUES (:user,:group,:label,:hash)");			
			$q->bindParam(":user", $_SESSION['user']['usersId']);
			$q->bindParam(":group", $group);
			$q->bindParam(":hash", $hash);
			$q->bindParam(":label", $label);
			$q->execute();

			// Return counter array
			if ($q->rowCount() > 0){	
				$q = $this->db->prepare("SELECT * from counters where countersId = LAST_INSERT_ID()");
				$q->execute();
				return $q->fetch();
			}else {
				die("Could not create counter");
				return array();
			}

		}

        public function fastcount($id, $value){

            assert(!empty($id));
            assert($value > 0);

            $value = intval($value);

            $q = $this->db->prepare("UPDATE counters set total = total + :value where countersId = :id");
            $q->bindParam(":id",$id);
            $q->bindParam(":value",$value);
            $q->execute();

            // Data point
            $consulta = $this->db->prepare("INSERT INTO datatracker (week,month,customersId,usersId,countersId,counter)
                VALUES  (YEARWEEK(CURDATE()),extract(YEAR_MONTH FROM CURDATE()), :customersId,:usersId, :kpi, :counter)");
                                
            $consulta->bindParam(":customersId",$_SESSION['user']['customersId']);
            $consulta->bindParam(":usersId",$_SESSION['user']['usersId']);
            $consulta->bindParam(":kpi",$id);
            $consulta->bindParam(":counter",$value);
            if ($consulta->execute()){
                return true;
            }else{
                return false;
            }

        }


		public function count($id, $value){

			assert(!empty($id));
			$value = intval($value);

			$q = $this->db->prepare("UPDATE counters set total = total + :value where countersId = :id");
			$q->bindParam(":id",$id);
			$q->bindParam(":value",$value);
			$q->execute();

			// Data point
			$consulta = $this->db->prepare("INSERT INTO datatracker (week,month,customersId,usersId,countersId,counter)
				VALUES  (YEARWEEK(CURDATE()),extract(YEAR_MONTH FROM CURDATE()), :customersId,:usersId, :kpi, :counter)");
						
		//	$consulta->bindParam(":hash",$hash);
			$consulta->bindParam(":customersId",$_SESSION['user']['customersId']);
			$consulta->bindParam(":usersId",$_SESSION['user']['usersId']);
			$consulta->bindParam(":kpi",$id);
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

		public function update($id, $label, $group, $addToCount = 0){

			$q = $this->db->prepare("UPDATE counters set label = :label, groupsId = :group where countersId = :id");
			$q->bindParam(":label",$label);
			$q->bindParam(":group",$group);
			$q->bindParam(":id",$id);
			$q->execute();

			if (intval($addToCount) > 0){
				$this->count($id, $addToCount);
			}

			return $this->get($id);

		}

		public function delete($id){

			$q = $this->db->prepare("DELETE FROM counters where countersId = :id");
			$q->bindParam(":id",$id);
			$q->execute();

			// Delete data points
			$q = $this->db->prepare("DELETE FROM datatracker where countersId = :id");
			$q->bindParam(":id",$id);
			$q->execute();		

			// Empty array()
			return array();	
		}		
}

