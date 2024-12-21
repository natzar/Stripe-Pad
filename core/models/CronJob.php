<?

/**
 * cron Job
 */
class cronJob
{

	var $name;
	var $emails;
	var $output;
	var $status;
	var $data;
	var $db;
	var $datatracker;
	var $execution_time = 0;
	var $mails;
	var $showOutput;

	function __construct($name, $showOutput = false)
	{
		if (empty($name)) die("need name for cronjob");

		$this->datatracker = new datatrackerModel();
		$this->db = SPDO::singleton();
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

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
