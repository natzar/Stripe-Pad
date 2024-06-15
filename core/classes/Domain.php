<?

class Domain extends Request {
	
	var $host;
	var $domain;	
	var $scheme;
	var $url;
	var $query;
	var $whois_answer;
	var $data = array();
	
	function __construct($url){
    	
    	 if (!isset($url) or empty($url)){
            echo 'Empty url';
            return;
        }
            
		$this->url = trim($url);
		$this->setDomain();	
	}
	
	protected function setDomain(){
		
		$PARSEDURL = parse_url($this->url);
		

		if (!$PARSEDURL) return false;

		if (!isset($PARSEDURL['host'])) $PARSEDURL['host'] = $PARSEDURL['path'];
		
		if (!filter_var($PARSEDURL['host'], FILTER_VALIDATE_URL)) {
					
			$PARSEDURL['host'] = $this->url;
			$PARSEDURL['host'] = str_replace("www.","",$PARSEDURL['host']);		
			$PARSEDURL['host'] = str_replace("https://","",$PARSEDURL['host']);		
			$PARSEDURL['host'] = str_replace("http://","",$PARSEDURL['host']);					
			$PARSEDURL['host'] = trim(str_replace("/","",$PARSEDURL['host']));	
			$this->domain = $this->host = $PARSEDURL['host'];
			$this->scheme = "https";
		}
		
		if (empty($this->host) or empty($this->url)){
			die("Webpage ".$this->url." doesn't seem an url");
		}

	

	}
	public function getHttpUrl(){
		return $this->scheme."://www.".$this->host;
	}

	public function whois(){
		
		//echo "WHOIS DOMAIN: ".$this->host.PHP_EOL;
// 		<?php
// require 'vendor/autoload.php';

// use phpWhois\Whois;

// $whois = new Whois();

// $domain = "example.com";
// $result = $whois->lookup($domain, false);

// if (isset($result['regrinfo']['registered']) && $result['regrinfo']['registered'] == 'no') {
//     echo $domain . " is available!";
// } else {
//     echo $domain . " is taken.";
// }
// 
		try{
			$domain = $this->host;
			$domainx = new Phois\Whois\Whois($domain);
			$whois_answer = @$domainx->info();
			
			$this->whois_answer = $whois_answer;
			
			$expires = "";
			
			// EXPIRATION DATE
		    $aux = explode("\n", $whois_answer);
		    $line = "";
		    foreach ($aux as $a){
		        //Registry Expiry Date: 2021-03-31T09:12:31Z
		        if (strstr($a, "Registry Expiry Date"))
		        {
		          //  echo $a;
		            $b = str_replace("Registry Expiry Date: ", "", trim($a));
		            $b = str_replace("Z", "", $b);
		            $b = str_replace("T", " ", $b);
		
		         //   echo 'expiry: ' . $b . PHP_EOL;
		            $c = date('Y-m-d h:i:s', strtotime(trim($b)));
		           // echo $c;
		            $expires = $c;
		        }
		    }
		
			$this->data['expires'] = $expires;
			$this->data['whois'] = $whois_answer;
		}	catch (Exception $e) {
			//slack($e->getMessage(),'error','webs',1);
			}	
		
	}
    
}