<?php


include "../core/sp-load.php";


class MonthlyEmail extends CronJob
{

	public function run()
	{
		$users = new usersModel();
		$mails = new mailsModel();

		$c = $users->getAll();

		foreach ($c as $user) {

			$extra_message = ""; //"Let me help you remember: Natzar lets you know when your favorite artists are playing just by logging in with your Spotify account. This is the first automated email from natzar.co. If you don't want to receive them, just reply with subject Unsubscribe please. I love feedback, let me know your comments and suggestions.<br><br>";

			$name = "";
			if (!preg_match('/[^A-Za-z0-9]/', $user['name'])) {
				$name = " " . ucfirst($user['name']);
			}

			$message = "Hi" . $name . ",<br><br>Beto from www.natzar.co here. Here you have " . count($output) . " fresh upcoming music concerts of your favorite artists for the next 30 days. <br><br>" . $extra_message;

			$message .= "link to , copyright....";
			$data['message'] = $message;

			$mails->sendTemplate('monthly-email', $data, $user['email'], APP_NAME . " " . date('F Y'));
		}
	}
}

$c = new MonthlyEmail('monthly-email');
