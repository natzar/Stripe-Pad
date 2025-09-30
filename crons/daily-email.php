<?php


include dirname(__FILE__) . "/../core/sp-load.php";


class DailyEmail extends CronJob

{
	var $inboxes;
	var $agents;
	var $emails;
	var $users;
	function run()
	{
		$this->agents = new agentsModel();
		$agents = $this->agents->get_active_agents();
		$this->inboxes = new inboxesModel();
		$this->emails = new emailsModel();
		$this->users = new usersModel();
		foreach ($agents as $agent) {
			$agentsId = $agent['agentsId'];
			$emails = $this->emails->get_yesterday_emails($agent['agentsId']);
			$msg = "";
			$total_emails = 0;
			if (empty($emails)) {
				continue;
			} else {
				$msg = "<ul>";

				foreach ($emails as $email) {
					if ($email['from_email'] == $agent['agent_email']) {
						// Skip emails sent to the agent itself
					} else {
						$total_emails++;
						$id =  !empty($email['parent_id']) ? $email['parent_id'] : $email['emailsId'];
						$msg .= "<li><a href='" . APP_DOMAIN . "app_conversations/inbox/" . $id . "'>" . $email['subject'] . "</a><br>" . $email['from_email'] . "</li>";
					}
				}
				$msg .= "</ul>";
			}

			if (empty($msg)) {
				log::system('No yesterday-emails found for agent: ' . $agentsId);
				continue;
			}

			$usersId = $this->agents->get_users_with_access($agentsId);
			$owners = array();

			foreach ($usersId as $item) {
				$owners[] = $this->users->get_by_id($item['usersId']);
			}


			if (empty($owners)) {
				log::system('No owners found for agent: ' . $agent['agentsId']);
				continue;
			}

			//	echo $msg;
			foreach ($owners as $user) {
				$mails = new mailsModel();
				$message = "Buenos días " . ucfirst($user['name']) . ",<br><br>Ayer se procesaron " . $total_emails . " emails, este es el resumen: <br><br>" . $msg;


				$data['body'] = $message;

				$mails->sendTemplate('daily-email', $data, $user['email'], APP_NAME . " " . date('d/m/Y'));
			}
		}
	}
}

$c = new DailyEmail('daily-email');
