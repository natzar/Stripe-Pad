<?

include dirname(__FILE__) . "/../core/sp-load.php";

$agents = new agentsModel();
$super_agent = $agents->get_all_details(1);
$emails = new emailsModel();
$email = $emails->get_by_id(636359, $super_agent);

$scResponse = EmailClassifier::classify_email($email, $super_agent);

print_r($scResponse);
