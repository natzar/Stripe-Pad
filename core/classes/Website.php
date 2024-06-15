<?
libxml_use_internal_errors(false);
use MadeITBelgium\Wappalyzer\Wappalyzer;



class Website extends Webpage { // Brutal!
	
	var $urls = array();	
	var $isCrawled;

	public function __construct($url){
		parent::__construct($url);



	}
	public function getTechnologies(){
		
        
		$wappalyzer = new Wappalyzer();			

		$output = $wappalyzer->analyze($url,$this->html_source,$this->data['headers']);			
		$this->data['technologies'] = $output['detected'];
		$this->data['lang'] = $output['lang'];
		$endTime = microtime(true);

		// Calculate the execution time in seconds
		$executionTime = $endTime - $startTime;

		// Print the execution time

		
	}
	public function crawl(){
		$crawler = new Crawler();
		$data = $crawler->visit($this->url);
		$this->urls = $data;
		$this->isCrawled = true;
		return $this->urls;

	}

	
	private function getRobotsFile(){
		$robotsFile = $this->getHttpUrl().'/robots.txt';
		try{
			if ($handle = $this->wget($robotsFile)){	
    			$this->data['robots'] = true;
			}
		}catch (Exception $e) {
			//slack($e->getMessage());	

		}	
	}

	public function getHosting(){
							
		if ($result = dns_get_record($this->host, DNS_ANY, $authns, $addtl)){

		$this->data['domain']['dns'] = $result;
		$this->data['domain']['authns'] = $authns;
		$this->data['domain']['addtl'] = $addtl;
		$hosting = "";
		foreach($result as $item){
			if ($item['type'] == "NS"){
				$aux = explode(".",$item['target']);
				$n = count($aux);
				$hosting = $aux[$n-2].".".$aux[$n-1];
				
			}
		}
		
		
		 if ($hosting == null or $hosting == "."){
			 
	  		$aux = explode("\n",$this->whois_answer);
	        $line = "";
	        foreach ($aux as $a)
	        {
	            if (strstr($a, "Name Server: "))
	            {
	                $b = explode(":", trim($a));
	                $c = explode(".", trim($b[1]));
	                $n = count($c);
	                $hosting = $c[$n - 2] . "." . $c[$n - 1];
	
	            }
	
	        }
	    }

	    if (!empty(trim($hosting))){
    		$this->data['hosting'] = $hosting;
    	}
    	}
	}




	public function findOrphanPages(){
		$sitemap = $this->getSitemapFile($this->domain);
		$links = $this->urls;
		foreach($links as $link){
			foreach($sitemap as $k => $url){
				if ($link['url'] == $url){
					unset($sitemap[$k]);
					continue;
				}
			}
		}
		return $sitemap;
	}
	function getSitemapFile(){
		$sitemap = array();
		
		$url = "https://".$this->domain."/";
		$sitemaps_default = array($url . "sitemap_index.xml", $url . "sitemap.xml", $url . "page-sitemap.xml", $url."post-sitemap.xml",$url.'category-sitemap.xml');
		foreach($sitemaps_default as $s){
			
							
			$xml = simplexml_load_string(file_get_contents($s));
			foreach ($xml->url as $url)
			{
			 	$sitemap[] = strval($url->loc);
			}

		}

		return $sitemap;
	}
	function countTotalPages(){
		
		$this->data['total_pages'] = count($this->getSitemapFile());

	}
	


	public function getRemoteData(){
		echo PHP_EOL.'auditorias_remote '.$this->host;
		$url = $this->host;
		$this->data['server'] = array();

		$intern = $this->wget($this->getHttpUrl().'/phpninja-remote.php?op=info&key=deadbeef');

		echo $this->getHttpUrl().'/phpninja-remote.php?op=info&key=deadbeef'.PHP_EOL;

		$intern = json_decode($intern,true);
		if (!empty($intern)){			
			$this->data['server'] = $intern;

		} else {
			$this->data['notices'][] = "Monitor no instalado";
			echo "Monitor no instalado";
//			installMonitorization();
		}		
	}
	
	public function getDetails($remote = false){
		// deprecated
		
		echo "Web details".PHP_EOL;
		$this->whois();
		$this->getHosting();
		
	//	$this->getMicroData();
//		$this->getGeoData();
//		$this->getLang();
		//$this->getRobotsFile();
		if ($remote){
			$this->getRemoteData();
		}
	
		return $this->data;
	}

	private function getSitemapRobots($url){

		$urlsitemaps = $url . "/robots.txt";
		$robots = $this->wget($urlsitemaps);
		$data = explode("\n", $robots);
        $sitemaps = array();
        //agafa els Sitemaps del sitemaps.txt si n'hi ha
        foreach ($data as $posts) {
            if (substr($posts, 0, 7) === "Sitemap") {
                preg_match("~[a-z]+://\S+~", $posts, $link);
                array_push($sitemaps, $link);
            }
        }
        $sitemaps = array_map('current', $sitemaps);

        return $sitemaps;
    }
	
}

// $url = "https://lahijadelmariachi.es";
// $ga_profile_id = '260697753';//'74553353';

// $seoaudit_text = new SEOAudit($url,$ga_profile_id);


// }