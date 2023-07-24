<?
/*
*	Cron Tickets - everyday 09:00 CEST
*
*
*
*/


include dirname(__FILE__)."/../core/load.php";

echo 'CRON CUSTOMERS';

	
class cronTickets extends cronJob{

	function run(){
	
		$this->SetDoneCompletedTickets();

		$today = intval(Date("d"));				
		$this->manageTickets(); // every day
		if ($today == "1" or $today == "15"){ // twice a month
			$this->createTicketsMantenimiento();
		}
	}

	function SetDoneCompletedTickets(){	
		$q= $this->db->prepare("UPDATE tickets set done = 1,progress=100, prioritysId = 1 where progress <> 100 and done <> 1 and ticketsstatusId in (4,5,6)");
		$q->execute();
	}

	function manageTickets(){
		
		// Mover to Archivo tickets cerrados creados hace mas de 
		$q = $this->db->prepare("update tickets set ticketsstatusId = 5,progress=100,done=1 where ticketsstatusId = 4 and updated < DATE_SUB(  NOW(), INTERVAL 2 WEEK)" );
		$q->execute();

		
		$tickets = new ticketsModel();
		$t = $tickets->getUrgents();
		$i=1;
		foreach($t as $ticket){			
			if ($ticket['prioritysId'] < 4){
				if ($i < 2){
					if (!$tickets->setPriority($ticket['ticketsId'],4)) echo 'error';		
				}else if ($i < 4){
					if (!$tickets->setPriority($ticket['ticketsId'],2)) echo 'error';		
				} else {
					$tickets->setPriority($ticket['ticketsId'],1);	
				}
			}
			$i++;
		}
	}
	// CADA 15 días
	function createTicketsMantenimiento(){		

		$start_date = Date("Y/m/d");
		$date = strtotime($start_date);
		$date = strtotime("+2 day", $date);
		$date_a = $date_b = date('Y-m-d', $date);
		$date = strtotime("+15 day", $date);
		$date_c = $date_d = date('Y-m-d', $date);
			
		$webs = new websModel();
		$ws = $webs->getWebsInMantenimiento();

		$today = intval(Date("d"));

		foreach($ws as $w){
			$q = $this->db->prepare("INSERT INTO tickets (websId,name,ticketsstatusId,tickettypeId,developersId) VALUES ('".$w['websId']."','Actualización core y módulos',5,14,1)");
			$q->execute();
			
			
			$q = $this->db->prepare("INSERT INTO tickets (websId,name,ticketsstatusId,tickettypeId,developersId) VALUES ('".$w['websId']."','Revisión backup. Vulnerabilidades, seguridad',5,14,1)");
			$q->execute();		
			
		}

	}

	// function createTicketFromLogs(){

	// if ($data['tag'] != "js-runtime"){
	
	// // add a ticket
	// $ticket = $tickets->create(array(
	// 	"customersId" => $customer['customersId'],
	// 	"ticketsstatusId" => 2,
	// 	"websId" => $web['websId'],
	// 	"usersId" => 1,
	// 	"description" => $data['tag']."<br><br>".$data['msg']."<br><br>URL:".$data['url']."<br><br>From Browser: ".$data['browser'],
	// 	"developersId" => 1000,
	// 	"name" => $title
	
	// ));

	// $comments->push('tickets',$ticket['ticketsId'],$data['msg'].$data['browser'],2000,false);
	// }
	
	// }




}

$c = new cronTickets('tickets');