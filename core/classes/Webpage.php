<?

use YusufKandemir\MicrodataParser\Microdata;


class Webpage extends Domain {

	
	var $html = null;
	var $ok = false;		
	var $sitemap;
	var $loaded = false;	
	public $html_source= "";	
	var $data = array();

	function __construct($url){
		
		parent::__construct($url);     
               $this->setDefaults();
        $this->virtualDom();
        $this->serializeHtml();
        
    }


    function virtualDom(){
// Gather website first url

		$wget = $this->wget_combi($this->getHttpUrl());
		
		if (isset($wget['error']) and $wget['error']){
			return $wget;
		}
		if (!isset($wget['response'])){
			echo "empty response";
			return false;
		}

		$this->data['headers'] = $wget['headers'];
		$this->data['connection'] = $wget['info'];
        
        $this->html_source = $wget['response'];
 	//	$this->html_source = htmlentities( $this->html_sourcex, ENT_QUOTES, 'UTF-8');

        if ($this->data['connection']['http_code'] != 200) {

        	return;
        }

        try{
	 		
	 		libxml_use_internal_errors(true);

	 		$doc = new DOMDocument();
			if (@$doc->loadHTML( trim($this->html_source) )){
			  	$this->html_source  =  $doc->saveHTML();
				
			}
			libxml_clear_errors();
			libxml_use_internal_errors(false);

	        $this->html = str_get_html( $this->html_source );
	       
			if(!$this->html){
				$this->html = file_get_html($this->getHttpUrl());
			}else{

			}
			if ($this->html)$this->loaded = true;

        }catch(Exception $e){

        }
       

		

    }
    function setDefaults(){
		$this->data['time'] = Date("Y-m-d H:i:s");
		$this->data['name'] = $this->host;
		$this->data['host'] = $this->host;
		$this->data['url'] = $this->url;
		$this->data['server'] = array();
		$this->data['seo'] = array();
		$this->data['seo']['description'] = "n/a";
		$this->data['seo']['title_tag'] = "n/a";
		$this->data['errors'] = array("warnings" => 0, "msg" => "", "fatals" => 0);
		$this->data['total_pages'] = 0;
		$this->data['server']['cms']['name'] = "";
		$this->data['server']['cms']['info']["cms_version"] = "n/a";
		$this->data['server']['cms']['info']["plugins"] = array();
		$this->data['server']['cms']['info']["theme"] = array("name" => "", "version" => "");
		$this->data['meta'] = array();
		$this->data['connection']['total_time'] = 0;
		$this->data['connection']['primary_port'] = 0;
		$this->data['connection']['http_code'] = 0;
		$this->data['emails'] = "";
		$this->data['cached'] = false;
		$this->data['links'] = array();
		$this->data['microdata'] = array();
		$this->data['scripts'] = array();
		$this->data['css'] = array();
		$this->data['headers'] = array();
		$this->data['technologies'] = array();
		$this->data['pagespeed'] = array();
		$this->data['checklist'] = array();
		$this->data['https'] = 0;
		$this->data['hosting'] = "n/a";
		$this->data['expires'] = "";
		$this->data['server']['php'] = "n/a";
		$this->data['responsive'] = true;
		$this->data['robots'] = false;
		$this->data['country'] = "";
		$this->data['favicon'] = null;
		$this->data['continent'] = "";
		$this->data['lang'] = "";
		
	}

	function getData(){
		return $this->data;
	}

	function serializeHtml(){
		if (!$this->loaded) return;
		if (isset($this->data['connection']['primary_port']))
		$this->data['https']= $this->data['connection']['primary_port'] == 443 ? 1 : 0;	
		$pattern = '/^(?:(?:\+|00)\d{1,3}\s?)?(?:\d{2,3}\s?\d{2,4}|\(?\d{2,5}\)?)\s?\d{2,4}\s?\d{2,4}$/';
	
	    $this->data['marketing']['phone'] =  preg_match($pattern,$this->html_source);
	    assert($this->html_source != "");
		if ($this->html){

			// SEO TAGS
			$this->data['seo']['h1'] = is_null($this->html->find('h1',0)) ? '': $this->html->find('h1',0)->plaintext;	
			$this->data['seo']['title_tag'] = is_null($this->html->find('title',0)) ? '': $this->html->find('title',0)->plaintext;
			$this->data['seo']['p'] = is_null($this->html->find('p',0)) ? '': $this->html->find('p',0)->plaintext;
		
			for ($j= 2;$j < 7;$j++){
			for ($i = 0; $this->html->find('h'.$j,$i);$i++){
				$this->data['seo']['h'.$j.":".$i] = is_null($this->html->find('h'.$j,$i)->plaintext) ? '' :  $this->html->find('h'.$j,$i)->plaintext;
			}
			}
			
			foreach($this->html->find('meta') as $e){
				if ($e->name == "description" or $e->name =="title"  or $e->name =="keywords"){
					$this->data['seo']['meta_'.$e->name] = $e->content;	
				}
			}
			
			
			$this->data['name'] = empty($this->data['seo']['title_tag']) ? $this->data['seo']['h1'] : $this->data['seo']['title_tag'];


		
			foreach ($this->html->find('script') as $e):
				if ($e->src != ""){
					$this->data['scripts'][] = $e->src;
				}
			endforeach;
			
			// get all css
			foreach ($this->html->find('link') as $e){
				$this->data['css'][] = $e->href;
			}
			
			// get all meta
			foreach ($this->html->find('meta') as $e){
			
				$this->data['meta'][$e->name] = $e->content;
				
				if ($e->name == "description" or $e->name == "title"){
				    $this->data['seo'][$e
				        ->name] = $e->content;
				}
				

				// if ($e->name == "generator" and !empty($e->content)){
				//     $this->data['server']['cms']['name'] = trim($e->content);
				// }
		
			}
			
			// Retrieve all images and print their SRCs
			foreach($this->html->find('img') as $e){
			    		    
				$this->data['images'][] = array("src" => $e->src, "alt" => $e->alt);
			}
			
			// get all links,  // Find all "A" tags and print their HREFs
			foreach ($this->html->find('a') as $e){
		
				 $this->data['links'][] = $e->href; //array("anchor" => $e->plaintext, "href" => $e->href);
			}
			
			// get all comments  
			foreach ($this->html->find('comment') as $e){
				$this->data['comments'][] = $e->outertext;
				if (strstr($e->outertext, "cache") or strstr($e->outertext, "Cache")){
					$this->data['cached'] = $e->outertext;
				}
			}

			// Favicon
			
			foreach ($this->html->find('link[rel=icon], link[rel=shortcut icon]') as $link) {
			    $href = $link->href;
			    if ($href) {
			        $this->data['favicon'] = $href;
			        break; // Favicon detected, no need to continue
			    }
			}

			
			// Extract Emails
			$regexp = '/([a-z0-9_\.\-])+(\@|\[at\])+(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
	    	preg_match_all($regexp, $this->html_source, $m);
    		$this->data['emails'] = isset($m[0]) ? implode(",",array_unique($m[0])) :'';



		}else{
			echo "No html valid";
			
		}

		preg_match('/(Warning\:(.*))/', $this->html_source, $output_array);
		$output_array = array_unique($output_array);
		$this->data['errors']['warnings'] = count($output_array);
		foreach($output_array as $m){
			$this->data['errors']['msg'] .= $m."<br>";
		}
	    preg_match('/(Fatal error\:(.*))/i', $this->html_source, $output_array);
    	$output_array = array_unique($output_array);
    	$this->data['errors']['fatals'] = count($output_array);

    	

    	foreach($output_array as $m){
			$this->data['errors']['msg'] .= $m."<br>";
		}

    	
		// Defaults
    	//$this->getMicroData();
    	$this->getGeoData();
    	$this->getLang();
    	$this->getCMS();
		$this->checkSecurityHeaders();
		$this->getPhpErrors();
		$this->errorsToText();			
			
			
			

	}




	function existKeywordInBody($keyword){

		return strstr($this->html_source, $keyword);

	}

	function getAllInterestingSEOElements(){
		
		
		return $this->data['seo'];

	}

	function getAllParagraphs(){

		$ps = array();
		if ($this->html)
		foreach ($this->html->find('p') as $e){
				
				$ps[] = $e->innertext;
		
		}
		return $ps;
	}

	function getAllLists(){

		$ps = array();
		if ($this->html){
		foreach ($this->html->find('ol') as $e){
				
				$ps[] = $e->outertext;
		
		}
		foreach ($this->html->find('ul') as $e){
				
				$ps[] = $e->outertext;
		
		}
		}
		return $ps;
	}

	function getMetaTags(){		
		return $this->data['meta'];
	}
	
	function getGeoData(){
		if (isset($this->data['connection']['primary_ip']) and function_exists('geoip_country_code_by_name')){
			$this->data['country'] = geoip_country_code_by_name($this->data['connection']['primary_ip']); 
			$this->data['continent'] = geoip_continent_code_by_name($this->data['connection']['primary_ip']);		
		}
	}

	function getLang(){
		if ($this->html and $this->html->find('html',0)){
			$this->data['lang'] = $this->html->find('html',0)->lang;			
		}
	}

		
	
	function getPhpErrors(){
		
		return $this->data['errors'];
	}

    public  function extract_emails($str){
    	// This regular expression extracts all emails from a string:
		
	}


	function getHtmlObject(){
		return $this->html;
	}

	function getLinks(){
		if ($this->html){
			$links = array();
			foreach($this->html->find('a') as $e){	
				$links[] = $e->href;
			}
			return array_unique($links);
		}else{ 			
			return array();
		
		}
		
	}
	
	public function getCMS($getVersion = false){
		
		$systems= array(
	        "Drupal",
	        "Prestashop",
	        "WordPress",
	        "Joomla",
	        "Liferay",
	        "vBulletin",
	        "Magento",
	        "ExpressionEngine",
	        "Sitecore",
	        'Bohemiasoft',
	        'EshopRychle',
	        'Fastcentrik',
	        'Shopsys',
	        'Shoptet',
	        'Webgarden',
	        'Webnode',
	        'Laravel',
	        'Concrete5',
	        'Squarespace',
	        'Typo3'
		);
		
		
		

		foreach($this->data['scripts'] as $item):
			
            if (strstr($item, "/templates/")) $this->data['server']['cms']['name']  = "Prestashop";
            if (strstr($item, "/modules/")) $this->data['server']['cms']['name']  = "Prestashop";
            if (strstr($item, "/sites/")) $this->data['server']['cms']['name'] = "Drupal";
            if (strstr($item, "wp-content")) $this->data['server']['cms']['name']  = "WordPress";
		
		endforeach;
		
		foreach($this->data['css'] as $item):
			
			
			if (strstr($item,"templates")) $this->data['server']['cms']['name'] = "Prestashop";
			if (strstr($item,"/sites/")) $this->data['server']['cms']['name'] = "Drupal";
			if (strstr($item,"wp-content")) $this->data['server']['cms']['name'] = "WordPress";
			
		endforeach;

		$searchTerms = array("WordPress", "Prestashop", "Drupal");
		
		if (isset($this->data['headers']) and !empty($this->data['headers'])){
			$headersString = implode(' ', $this->data['headers']);

			foreach ($searchTerms as $term) {
			    if (stripos($headersString, $term) !== false) {
			        // Term found in headers
			        $this->data['server']['cms']['name'] = $term;
			        break; // Exit the loop if any term is found
			    }
			}
		}

		if (!empty($this->data['technologies']) and empty($this->data['server']['cms']['name'])): 
			foreach($this->data['technologies'] as $k => $v){
				if (in_array($k,$searchTerms)) {
					$this->data['server']['cms']['name'] = $k;
					break;
				}
			}

		endif; 

		if (empty($this->data['server']['cms']['name'])):   
			foreach($systems as $s):
				if (strstr($this->html_source, $s)){
					 $this->data['server']['cms']['name'] = $s;
				}
			endforeach;			
		endif;
		
		// if (isset($this->data['meta']['generator']) and !empty($this->data['meta']['generator']) ){
		// 	$this->data['server']['cms']['name'] = $this->data['meta']['generator'];	
		// } 
		    
		if ($this->data['server']['cms']['name'] == "WordPress" and $getVersion){
	        $rss = new DOMDocument();
			if (@$rss->load('https://' . $this->host . '/feed')){
            	
				$version = str_replace("https://wordpress.org/?v=", "", $rss->getElementsByTagName('generator')
                ->item(0)
                ->nodeValue);

				$this->data['server']['cms']['info']['cms_version'] = $version;
        	}
    	}

    	if ($this->data['server']['cms']['name'] == "WordPress"){
			
			if (strpos($this->html_source,"woocommerce") !== false){
	    		$this->data['server']['cms']['info']['woocommerce'] = true;
			
			}
    	}


    	return $this->data['server']['cms']['name'];


	}
	
	function getHttpCode(){
		return $this->data['connection']['http_code'];
	}

	private function reset(){
		$this->data = array();
		$this->whois_answer = null;
		$this->host = null;
		$this->html = null;
		$this->url = null;
	}

	public function getMicroData(){
			$microdata = null;
			$this->data['microdata'] = $microdata;
			try{
			 if ($microdata = @Microdata::fromHTMLFile('https://'.$this->url)){
				$microdata = $microdata->toArray(); 	
			 }
						
			
			}catch(Exception $e){
				echo $e;
			}

			if (!is_null($microdata))
			$this->data['microdata'] = $microdata;

			return $microdata;
 
	}
	public function errorsToText(){
		// if ($this->data['server']['cms']['info']['cms_version'] < 5 and $this->data['server']['cms']['name'] == "WordPress"){
		// 	$this->data['notices'][] = array(
		// 		"msg" => "WordPress está desactualizado"
		// 	);
		// } 
		$issues = array(
    array(
        "category" => "Content Quality",
        "task" => "Proofread content",
        "status" => 0,
        "description" => "Check for typos, grammar errors, and readability."
    ),
    array(
        "category" => "Content Quality",
        "task" => "Optimize images",
        "status" => 0,
        "description" => "Ensure images are properly sized and compressed for web."
    ),
    array(
        "category" => "Content Quality",
        "task" => "Use alt text for images",
        "status" => 0,
        "description" => "Add descriptive alt text to images for accessibility and SEO."
    ),
    array(
        "category" => "Usability and Functionality",
        "task" => "Test forms and buttons",
        "status" => 0,
        "description" => "Ensure all forms and buttons work correctly."
    ),
    array(
        "category" => "Usability and Functionality",
        "task" => "Check multimedia files",
        "status" => 0,
        "description" => "Verify that audio and video files play properly."
    ),
    array(
        "category" => "Navigation and Accessibility",
        "task" => "Review navigation structure",
        "status" => 0,
        "description" => "Check if navigation is intuitive and easy to use."
    ),
    array(
        "category" => "Navigation and Accessibility",
        "task" => "Test on-site search",
        "status" => 0,
        "description" => "Ensure the search functionality works and produces relevant results."
    ),
    array(
        "category" => "Performance and Speed",
        "task" => "Optimize website speed",
        "status" => 0,
        "description" => "Compress images, reduce HTTP requests, and optimize code for faster loading."
    ),
    array(
        "category" => "Performance and Speed",
        "task" => "Check page load times",
        "status" => 0,
        "description" => "Test and improve load times for optimal user experience."
    ),
    array(
        "category" => "Security and Privacy",
        "task" => "Implement SSL certificate",
        "status" => 0,
        "description" => "Ensure secure data transmission with an SSL certificate."
    ),
    array(
        "category" => "Security and Privacy",
        "task" => "Set up backup solution",
        "status" => 0,
        "description" => "Install a backup solution to prevent data loss."
    ),
    array(
        "category" => "SEO and Analytics",
        "task" => "Configure SEO plugin",
        "status" => 0,
        "description" => "Optimize pages with metadata, titles, and keywords using an SEO plugin."
    ),
    array(
        "category" => "SEO and Analytics",
        "task" => "Set up Google Analytics",
        "status" => 0,
        "description" => "Install and configure Google Analytics to track website performance."
    ),
    array(
        "category" => "Browser Compatibility",
        "task" => "Test on multiple browsers",
        "status" => 0,
        "description" => "Check website appearance and functionality on various browsers."
    ),
    array(
        "category" => "Mobile-Friendly Design",
        "task" => "Check mobile responsiveness",
        "status" => 0,
        "description" => "Ensure the website is user-friendly on mobile devices."
    ),
    array(
        "category" => "Legal and Compliance",
        "task" => "Add necessary legal pages",
        "status" => 0,
        "description" => "Include terms of service, privacy policy, and other required legal content."
    ),
    array(
        "category" => "Legal and Compliance",
        "task" => "Check for GDPR compliance",
        "status" => 0,
        "description" => "Ensure compliance with data protection regulations."
    ),
    array(
        "category" => "Final Checks",
        "task" => "Delete unused plugins",
        "status" => 0,
        "description" => "Remove unnecessary plugins for a streamlined website."
    ),
    array(
        "category" => "Final Checks",
        "task" => "Perform a final review",
        "status" => 0,
        "description" => "Thoroughly review the entire website for any missed issues."
    ),
    array(
        "category" => "Server Monitoring",
        "task" => "Receive error or event notifications",
        "status" => 0,
        "description" => "Set up notifications to receive alerts about errors or events in the system."
    ),
    array(
        "category" => "Server Monitoring",
        "task" => "Server logs",
        "status" => 0,
        "description" => "Monitor and review logs from the server to identify issues or anomalies."
    ),

    

    array(
        "category" => "SEO on Page",
        "task" => "Title Tag",
        "status" => !empty($this->data['seo']['title_tag']),
        "description" => "Optimize on-page elements such as metadata, headings, and content for better search engine rankings."
    ),


    array(
        "category" => "SEO on Page",
        "task" => "Meta Description",
        "status" => !empty($this->data['meta']->description),
        "description" => "Optimize on-page elements such as metadata, headings, and content for better search engine rankings."
    ),

array(
        "category" => "SEO on Page",
        "task" => "At least 1 H1",
        "status" => !empty($this->data['seo']['h1']),
        "description" => "Optimize on-page elements such as metadata, headings, and content for better search engine rankings."
    ),

array(
        "category" => "SEO on Page",
        "task" => "Only 1 H1",
        "status" => 0,// @(@$this->html->find('h1') and @is_array($this->html->find('h1')) and @count($this->html->find('h1')) == 1),
        "description" => "Optimize on-page elements such as metadata, headings, and content for better search engine rankings."
    ),





    array(
        "category" => "Server Management",
        "task" => "Php Version",
        "status" => $this->data['server']['php'] < 7.2,
        "description" => "Manage and maintain the server to ensure its smooth operation."
    ),
    array(
        "category" => "Server Management",
        "task" => "External services",
        "status" => 0,
        "description" => "Integrate and manage external services used by the application."
    ),
    array(
        "category" => "Content Management",
        "task" => "Content",
        "status" => 0,
        "description" => "Create, update, and manage content on the website or application."
    ),
    array(
        "category" => "Visual Design",
        "task" => "Visual",
        "status" => 0,
        "description" => "Ensure visually appealing design and layout of the website or application."
    ),
    array(
        "category" => "Google Relations",
        "task" => "Sitemap",
        "status" => empty($this->data['sitemap']),
        "description" => "Sitemap.xml is a file containing all URLs in your site for easy indexing"
    ),
    array(
        "category" => "Google Relations",
        "task" => "Robots.txt",
        "status" => empty($this->data['robots']),
        "description" => "Sitemap.xml is a file containing all URLs in your site for easy indexing"
    ),
    array(
        "category" => "Maintenance",
        "task" => "Updates",
        "status" => 0,
        "description" => "Regularly update the website or application with new features and improvements."
    ),
    array(
        "category" => "Maintenance",
        "task" => "Errors, changes",
        "status" => 0,
        "description" => "Address errors and implement requested changes as part of ongoing maintenance."
    ),
    array(
        "category" => "Documentation",
        "task" => "Changelog",
        "status" => 0,
        "description" => "Maintain a changelog to document updates, fixes, and enhancements."
    ),
    array(
        "category" => "Documentation",
        "task" => "Simple History",
        "status" => 0,
        "description" => "Keep a record of changes and activities using a simple history log."
    ),
    array(
        "category" => "Content and Design",
        "task" => "Check for typos, grammatical errors, and formatting issues in all text content.",
        "status" => 0,
        "description" => "Ensure all text content is free of typos and grammatical errors. Verify proper formatting for consistent presentation."
    ),
    array(
        "category" => "Content and Design",
        "task" => "Optimize images and use relevant alt tags",
        "status" => 0,
        "description" => "Ensure images are optimized for web loading speed and include alt tags for accessibility and SEO purposes."
    ),
    array(
        "category" => "Content and Design",
        "task" => "Verify consistent fonts and colors",
        "status" => 0,
        "description" => "Ensure fonts and color choices are uniform across all pages for a cohesive visual experience."
    ),
    array(
        "category" => "Performance and Speed",
        "task" => "Evaluate website loading speed",
        "status" => 0,
        "description" => "Use tools such as Google PageSpeed Insights or GTmetrix to assess and enhance website loading speed."
    ),
    array(
        "category" => "Performance and Speed",
        "task" => "Optimize images and implement caching",
        "status" => 0,
        "description" => "Enhance loading times by optimizing image sizes and utilizing caching plugins for improved performance."
    ),
    array(
        "category" => "Performance and Speed",
        "task" => "Check for broken links",
        "status" => 0,
        "description" => "Use tools like Broken Link Checker to identify and fix any broken links that could affect user experience."
    ),
    array(
        "category" => "Responsiveness",
        "task" => "Test website on various devices",
        "status" => 0,
        "description" => "Ensure the website displays and functions correctly on different devices, including desktops, tablets, and mobiles."
    ),
    array(
        "category" => "Responsiveness",
        "task" => "Meta Viewport tag for Responsiveness",
        "status" => isset($this->data['meta']['viewport']),
        "description" => "Confirm that all elements are correctly aligned and easily readable on smaller screens."
    ),
    array(
        "category" => "Navigation and User Experience",
        "task" => "Test navigation links and menus",
        "status" => 0,
        "description" => "Thoroughly test all navigation links and menus to guarantee proper functioning and accurate routing."
    ),
    array(
        "category" => "Navigation and User Experience",
        "task" => "Check Favicon",
        "status" => !is_null($this->data['favicon']),
        "description" => "Favicon needs to be set"
    ),
    array(
        "category" => "Navigation and User Experience",
        "task" => "Check buttons, forms, and call-to-action elements",
        "status" => 0,
        "description" => "Ensure buttons, forms, and calls-to-action perform as intended and lead users to the right destinations."
    ),
    array(
        "category" => "Contact Forms and Opt-ins",
        "task" => "Test contact form functionality",
        "status" => 0,
        "description" => "Verify that contact forms are sending emails correctly and capturing user submissions accurately."
    ),
    array(
        "category" => "Contact Forms and Opt-ins",
        "task" => "Confirm opt-in form functionality",
        "status" => 0,
        "description" => "Ensure opt-in forms for newsletters or promotions work properly and register users as expected."
    ),
    array(
        "category" => "SEO Optimization",
        "task" => "Optimize meta titles and descriptions",
        "status" => 0,
        "description" => "Craft unique and pertinent meta titles and descriptions for each page to enhance search engine visibility."
    ),
    array(
        "category" => "SEO Optimization",
        "task" => "Verify permalinks and keywords",
        "status" => 0,
        "description" => "Check permalinks for correct structure and inclusion of relevant keywords to boost SEO performance."
    ),
    array(
        "category" => "SEO Optimization",
        "task" => "Install and configure SEO plugin",
        "status" => 0,
        "description" => "Implement an SEO plugin to optimize on-page SEO factors and improve search engine rankings."
    ),
    array(
        "category" => "Browser Compatibility",
        "task" => "Test website on various browsers",
        "status" => 0,
        "description" => "Verify that the website appears and operates consistently across multiple browsers, including Chrome, Firefox, Safari, and Edge."
    ),
    array(
        "category" => "Security",
        "task" => "Keep software up-to-date",
        "status" => 0,
        "description" => "Regularly update PrestaShop, modules, and themes to stay protected against security vulnerabilities."
    ),
    array(
        "category" => "Security",
        "task" => "Install security module",
        "status" => 0,
        "description" => "Implement a security module to monitor and prevent malicious activities, enhancing website protection."
    ),
    array(
        "category" => "Backups and Recovery",
        "task" => "Regularly back up website",
        "status" => 0,
        "description" => "Perform regular backups of your PrestaShop website using a reliable backup solution to prevent data loss."
    ),
    array(
        "category" => "Backups and Recovery",
        "task" => "Test backup restoration",
        "status" => 0,
        "description" => "Periodically test the backup restoration process to ensure your ability to recover the website if necessary."
    ),
    array(
        "category" => "Analytics and Tracking",
        "task" => "Integrate Google Analytics",
        "status" => 0,
        "description" => "Integrate Google Analytics to track website traffic, user behavior, and key performance metrics."
    ),
    array(
        "category" => "Analytics and Tracking",
        "task" => "Verify tracking codes",
        "status" => 0,
        "description" => "Check the installation and functionality of tracking codes for tools like Google Tag Manager to collect accurate data."
    ),
    array(
        "category" => "Social Media Integration",
        "task" => "Test social media buttons",
        "status" => 0,
        "description" => "Test social media sharing buttons to ensure they properly share content on various social platforms."
    ),
    array(
        "category" => "Social Media Integration",
        "task" => "Check social media icons",
        "status" => 0,
        "description" => "Confirm that social media icons link to the correct social media profiles or pages."
    ),
    array(
        "category" => "E-commerce (PrestaShop Specific)",
        "task" => "Test checkout process",
        "status" => 0,
        "description" => "Thoroughly test the entire checkout process, including adding products, managing the cart, and completing payments."
    ),
    array(
        "category" => "E-commerce (PrestaShop Specific)",
        "task" => "Verify product details",
        "status" => 0,
        "description" => "Ensure accuracy of product images, descriptions, prices, and other details to provide reliable information to customers."
    ),
    array(
        "category" => "E-commerce (PrestaShop Specific)",
        "task" => "Check payment gateway",
        "status" => 0,
        "description" => "Verify that the payment gateway is functioning smoothly, securely, and allowing seamless transactions."
    ),
    array(
        "category" => "Accessibility",
        "task" => "Run accessibility tests",
        "status" => 0,
        "description" => "Perform accessibility tests to ensure the PrestaShop website is usable by individuals with disabilities."
    ),
    array(
        "category" => "Accessibility",
        "task" => "Add alt text and use headings",
        "status" => 0,
        "description" => "Ensure all images have proper alt text and use headings appropriately to improve accessibility and navigation."
    ),
    array(
        "category" => "Legal Compliance",
        "task" => "Check legal pages",
        "status" => 0,
        "description" => "Confirm the presence of necessary legal pages, including Privacy Policy and Terms and Conditions."
    ),
    array(
        "category" => "Legal Compliance",
        "task" => "Ensure regulatory compliance",
        "status" => 0,
        "description" => "Ensure the website complies with relevant regulations, such as GDPR (General Data Protection Regulation) and CCPA (California Consumer Privacy Act)."
    ),
    array(
        "category" => "PrestaShop Modules and Themes",
        "task" => "Update and test modules and themes",
        "status" => 0,
        "description" => "Regularly update and thoroughly test PrestaShop modules and themes for compatibility, security, and functionality."
    ),
    array(
        "category" => "PrestaShop Modules and Themes",
        "task" => "Validate customizations and third-party modules",
        "status" => 0,
        "description" => "Ensure that customizations and third-party modules function seamlessly and do not disrupt the website's operation."
    ),
    array(
        "category" => "Final Review",
        "task" => "Perform a comprehensive final review",
        "status" => 0,
        "description" => "Conduct a thorough review of all pages to ensure accuracy, consistency, and alignment with the website's branding and goals."
    )
);

		
	
		$col = array_column( $issues, "category" );
		array_multisort( $col, SORT_ASC, $issues );

		foreach($issues as $issue){
			$this->data['checklist'][] = $issue;	
		}
		
	}

	private function checkSecurityHeaders(){

		$expectedHeaders = [
		    'X-XSS-Protection: 0',
		    'X-Frame-Options: DENY',
		    'X-Content-Type-Options: nosniff',
		    'Strict-Transport-Security: max-age=10886400; includeSubDomains; preload'
		];

		// Descriptions = https://blog.stefanolaru.com/essential-http-security-headers

		foreach ($expectedHeaders as $expectedHeader) {
	        if (in_array($expectedHeader, $this->data['headers'])) {
	            // Found
	            $this->data['checklist'][] = array("category" => "Security", "Task" => $expectedHeader, "status" => 1, "description" => $expectedHeader);

	        } else {
	            
				$this->data['checklist'][] = array("category" => "Security", "Task" => $expectedHeader, "status" => 0, "description" => $expectedHeader);


	        }
		}

				
	}
}