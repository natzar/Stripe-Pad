<?




class GAnalytics {
	
	var $service;
	var $profileId;

	function __construct($profileId){
    $profileId = trim($profileId);

		if (!isset($profileId) or empty($profileId) or $profileId == "") return null;
		$this->profileId = $profileId;
		$client = new Google_Client();
        $client->setClientId('693708698423-3409b4j14skerpi5rfpolf35t3qu9gff.apps.googleusercontent.com');
        $client->setClientSecret('LLgHisRpl1HgMWdG4PEvawyR');
        $client->setRedirectUri('https://accounts.google.com/o/oauth2/v2/auth');
        $client->setScopes('https://www.googleapis.com/auth/analytics.readonly');
        $client->setState('offline');
        $client->refreshToken('1//04CYMJAsHkcCxCgYIARAAGAQSNwF-L9IrEEXO4P7SmJ2fepDRk1JDpBRiX4egThVhI_wV05tGNpwhtVVtlirUEQmZSAe554_VITU');
        $newtoken = $client->getAccessToken();
        $client->setAccessToken($newtoken);
        $analytics = new Google_Service_Analytics($client);
        $this->service = $analytics;
        return $this;

	}
	

	function getPageViewsByUrl($url) {
    if (is_null($this->service))return null;
		if (empty($url)) return 0;
		
	    $optParams = array(
	          'filters' => 'ga:pagePath=@'.$url
	    );

	    return $this->returnResults($this->service->data_ga->get(
	        'ga:' . $this->profileId,
	        '2022-05-01',
	        'today',
	        'ga:pageViews',
	        $optParams
	    ));
	}

    function getResultsSessions( ) {

	    if (!isset($this->service->data_ga)){
		    return false;
	    }
      return @$this->service->data_ga->get(
          'ga:' . $this->profileId,
          '7daysAgo',
          'today',
          'ga:sessions'); // ga:sessions,
    }

    function getResults() {
	    if (!isset($this->service->data_ga)){
		    return false;
	    }
      return @$this->service->data_ga->get(
          'ga:' . $this->profileId,
          '7daysAgo',
          'today',
          'ga:pageviews,ga:sessions,ga:newUsers,ga:percentNewSessions,ga:pageviewsPerSession,ga:uniquePageviews'); // ga:sessions,
    }
 
    function returnResults($results) {
        // Parses the response from the Core Reporting API and prints
        // the profile name and total sessions.
        if (@$rows = $results->getRows()) {
            // Get the profile name.
            $profileName = $results->getProfileInfo()->getProfileName();
 
            // Get the entry for the first entry in the first row.
            //$rows = $results->getRows();
            return $rows[0][0];
        } else {
           return 0; // print "<p>No results found.</p>";
        }
    }
}
 
    