<?
	/* Function which can Block unwanted Requests
 * @return array of error messages
 */
function requestBlocker()
{
        /*
        Version 1.0 11 Jan 2013
        Author: Szczepan K
        http://www.szczepan.info
        me[@] szczepan [dot] info
        ###Description###
        A PHP function which can Block unwanted Requests to reduce your Website-Traffic.
        God for Spiders, Bots and annoying Clients.

        */

        # Before using this function you must 
        # create & set this directory as writeable!!!!
        $dir = dirname(__FILE__).'/';

        $rules   = array(
                #You can add multiple Rules in a array like this one here
                #Notice that large "sec definitions" (like 60*60*60) will blow up your client File
                array(
                        //if >5 requests in 5 Seconds then Block client 15 Seconds
                        'requests' => 7, //5 requests
                        'sek' => 7, //5 requests in 5 Seconds
                        'blockTime' => 10 // Block client 15 Seconds
                ),
                array(
                        //if >10 requests in 30 Seconds then Block client 20 Seconds
                        'requests' => 20, //10 requests
                        'sek' => 30, //10 requests in 30 Seconds
                        'blockTime' => 50 // Block client 20 Seconds
                ),
                array(
                        //if >200 requests in 1 Hour then Block client 10 Minutes
                        'requests' => 100, //200 requests
                        'sek' => 60 * 60, //200 requests in 1 Hour
                        'blockTime' => 600  // Block client 10 Minutes
                )
        );
        $time    = time();
        $blockIt = array();
        $user    = array();

        #Set Unique Name for each Client-File 
        $user[] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'IP_unknown';
        $user[] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $user[] = strtolower(gethostbyaddr($user[0]));

        # Notice that I use files because bots do not accept Sessions
        $botFile = $dir . substr($user[0], 0, 8) . '_' . substr(md5(join('', $user)), 0, 5) . '.txt';


        if (file_exists($botFile)) {
                $file   = file_get_contents($botFile);
                $client = unserialize($file);

        } else {
                $client                = array();
                $client['time'][$time] = 0;
        }

        # Set/Unset Blocktime for blocked Clients
        if (isset($client['block'])) {
                foreach ($client['block'] as $ruleNr => $timestampPast) {
                        $elapsed = $time - $timestampPast;
                        if (($elapsed ) > $rules[$ruleNr]['blockTime']) {
                                unset($client['block'][$ruleNr]);
                                continue;
                        }
                        $blockIt[] = 'Block active for Rule: ' . $ruleNr . ' - unlock in ' . ($elapsed - $rules[$ruleNr]['blockTime']) . ' Sec.';
                }
                if (!empty($blockIt)) {
                        return $blockIt;
                }
        }

        # log/count each access
        if (!isset($client['time'][$time])) {
                $client['time'][$time] = 1;
        } else {
                $client['time'][$time]++;

        }

        #check the Rules for Client
        $min = array(
                0
        );
        foreach ($rules as $ruleNr => $v) {
                $i            = 0;
                $tr           = false;
                $sum[$ruleNr] = 0;
                $requests     = $v['requests'];
                $sek          = $v['sek'];
                foreach ($client['time'] as $timestampPast => $count) {
                        if (($time - $timestampPast) < $sek) {
                                $sum[$ruleNr] += $count;
                                if ($tr == false) {
                                        #register non-use Timestamps for File 
                                        $min[] = $i;
                                        unset($min[0]);
                                        $tr = true;
                                }
                        }
                        $i++;
                }

                if ($sum[$ruleNr] > $requests) {
                        $blockIt[]                = 'Limit : ' . $ruleNr . '=' . $requests . ' requests in ' . $sek . ' seconds!';
                        $client['block'][$ruleNr] = $time;
                }
        }
        $min = min($min) - 1;
        #drop non-use Timestamps in File 
        foreach ($client['time'] as $k => $v) {
                if (!($min <= $i)) {
                        unset($client['time'][$k]);
                }
        }
        $file = file_put_contents($botFile, serialize($client));


        return $blockIt;

}


if ($t = requestBlocker()) {
        echo 'mmmm... how to say it';
        print_r($t);
        die();

} else {

}
