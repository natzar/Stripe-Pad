<?php

/**
 * Package Name: Stripe Pad
 * File Description: Cronjob Extendable Class
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
 * cron Job
 */
class cronJob extends ModelBase
{

	var $name;
	var $emails;
	var $output;
	var $status;
	var $data;
	var $db;
	var $mails;
	var $datatracker;
	var $execution_time = 0;
	var $showOutput;
	var $log;

	function __construct($name, $showOutput = false)
	{
		parent::__construct();
		if (empty($name)) die("need name for cronjob");
		$this->log = log::singleton();

		$this->mails = new mailsModel();
		$this->name = $name;

		// if (is_cli()){
		// 	$showOutput = true;
		// }

		$this->showOutput = $showOutput;
		echo PHP_EOL . "Starting up cronjob " . $name . PHP_EOL;
		$this->prepareExecution();
		$start_time = microtime(true);
		try {
			$this->run();
		} catch (Exception $e) {
			$this->output = $e->getMessage();
			echo $this->output;
		}
		$end_time = microtime(true);

		// Calculate script execution time
		$this->execution_time = ($end_time - $start_time);



		$this->finish();
	}
	function prepareExecution()
	{
		$this->status = 0;
		$this->saveStatus();
		$this->saveExecution();

		$q = $this->db->prepare("SELECT * from crons  where name = :name");
		$q->bindParam(":name", $this->name);
		$q->execute();

		$this->data = $q->fetch();

		if (!isset($this->data['cronsId'])) {
			$q = $this->db->prepare("INSERT INTO crons (name) VALUES (:name)");
			$q->bindParam(":name", $this->name);
			$q->execute();
			$this->data['name'] = $this->name;
		}
		$q = $this->db->prepare("UPDATE crons set output = CONCAT('Running... \n Last: ', output)  where name = :name");
		$q->bindParam(":name", $this->name);
		$q->execute();
		if (!$this->showOutput) ob_start();
	}
	function saveExecution()
	{
		$q = $this->db->prepare("UPDATE crons set last = NOW() where name = :name");
		$q->bindParam(":name", $this->name);
		$q->execute();
	}
	function saveOutput()
	{
		$this->output = "DONE - " . $this->output;
		$q = $this->db->prepare("UPDATE crons set output = :out where name = :name");

		$q->bindParam(":name", $this->name);
		$q->bindParam(":out", $this->output);
		$q->execute();
	}
	function saveStatus()
	{
		$q = $this->db->prepare("UPDATE crons set status = :status where name = :name");
		$q->bindParam(":name", $this->name);
		$q->bindParam(":status", $this->status);
		$q->execute();
	}
	function run()
	{
		echo 'default';
	}
	function finish()
	{

		if (!$this->showOutput) {
			$this->output = ob_get_contents();
			$this->output .= "<br>Execution time: " . $this->execution_time;
			ob_end_clean();
			$this->saveOutput();
		} else {
			echo $this->output;
			echo "Execution time: " . $this->execution_time;
		}
		$this->status = 1;
		$this->saveStatus();
	}
}
