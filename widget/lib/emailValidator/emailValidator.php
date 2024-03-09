<?


Class EmailValidator {
	var $email;
	var $blockedDomains;

	function __construct(){
		
		require_once("blockedDomains.php");
		$this->blockedDomains = $blockedDomains;
	}

	public function isValid($email) {
		
		if (empty($email)) return false;
		$this->email = trim($email);
		return !$this->isRoleEmail() and $this->isValidFormat() and !$this->isBlockedDomain() and $this->isValidDns();

	}
	private function isValidFormat(){
		$email = $this->email;

		$email_regex = "/^[-!#$%&'*+\/0-9=?A-Z^_a-z`{|}~](\.?[-!#$%&'*+\/0-9=?A-Z^_a-z`{|}~])*@[a-zA-Z0-9](-*\.?[a-zA-Z0-9])*\.[a-zA-Z](-?[a-zA-Z0-9])+$/";

		// check for email
		if (!$email) {
		    return false;
		}

		// trim from spaces
		$email = trim($email);

		// check for parts
		$parts = explode('@', $email);
		$local_part = $parts[0];

		if (!isset($parts[1])) return false;
		
		$domain = $parts[1];

		// if no localpart, stop
		if (strpos($email, '@') == -1 || !$local_part || !strlen($local_part)) {
		    return false;
		}
		// if no domain, stop
		if (!$domain || !strlen($domain)) {
		    return false;
		}

		// if localpart exceeds 64
		if (strlen($local_part) > 64) {
		    return false;
		}

		// if domain exceeds 255
		if (strlen($domain) > 255) {
		    return false;
		}

		// if domain part exceeds 64
		$domain_parts = explode('.', $domain);
		if (strlen($domain_parts[1]) > 64) {
		    return false;
		}

		// check gmail local part requirements
		if ($domain == 'gmail.com' && strlen($local_part) < 6) {
		    return false;
		}

		// test the format with a regex
		if (!preg_match($email_regex, $email)) {
		    return false;
		}

		return true;


	}
	private function isBlockedDomain(){
		
		return in_array($this->email, $this->blockedDomains);
	}
	
	private function isValidDns(){
		$parts = explode('@', $this->email);
		dns_get_mx($parts[1],$mx);
		return !empty($mx);
	}
	private function isRoleEmail(){
		$roles = [
        "abuse",
        "admin",
        "billing",
        "compliance",
        "devnull",
        "dns",
        "ftp",
        "hostmaster",
        "inoc",
        "ispfeedback",
        "ispsupport",
        "list-request",
        "list",
        "maildaemon",
        "noc",
        "no-reply",
        "noreply",
        "null",
        "phish",
        "phishing",
        "postmaster",
        "privacy",
        "registrar",
        "root",
        "security",
        "spam",
        "support",
        "sysadmin",
        "sales",
        "tech",
        "test",
        "undisclosed-recipients",
        "unsubscribe",
        "usenet",
        "uucp",
        "webmaster",
        "www",
    	];
    	$parts = explode('@', $this->email);
    	return in_array($parts[0],$roles);
	}
}