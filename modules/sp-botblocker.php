<?php
/* Function which can Block unwanted Requests
 * @return array of error messages
 */

class BotBlocker
{

        function __construct()
        {
                $this->check_user_agent();
                $this->check_headers();
                if ($this->rate_limit_exceeded()) $_SESSION['errors'][] = 'You are hitting limits ...<br>';
        }

        function check_user_agent()
        {
                $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

                // Whitelist for search engines (Google, Bing, etc.)
                $whitelist = [
                        '/googlebot/i', // Google
                        '/bingbot/i',   // Bing
                        '/yahoo/i',     // Yahoo
                        '/duckduckbot/i', // DuckDuckGo
                        '/baiduspider/i', // Baidu
                        '/yandex/i'     // Yandex
                ];

                // Blocked bots
                $botPatterns = [
                        '/wget/i',
                        '/curl/i',
                        '/python/i',
                        '/selenium/i',
                        '/headless/i',
                        '/playwright/i',
                        '/phantomjs/i',
                        '/scrapy/i'
                ];

                // Allow whitelisted bots
                foreach ($whitelist as $pattern) {
                        if (preg_match($pattern, $userAgent)) {
                                return; // Stop execution, allow search engine
                        }
                }

                // Block other bots
                foreach ($botPatterns as $pattern) {
                        if (preg_match($pattern, $userAgent)) {
                                die('Access Denied: Bot Detected');
                        }
                }
        }

        function check_headers()
        {
                $userAgent = $_SERVER['HTTP_USER_AGENT'];

                $requiredHeaders = ['HTTP_ACCEPT', 'HTTP_ACCEPT_LANGUAGE', 'HTTP_ACCEPT_ENCODING', 'HTTP_USER_AGENT'];

                foreach ($requiredHeaders as $header) {
                        if (!isset($_SERVER[$header])) {
                                die('Access Denied: Suspicious Headers');
                        }
                }
                $connection = $_SERVER['HTTP_CONNECTION'] ?? '';

                if (preg_match('/keep-alive/i', $connection) && strpos($userAgent, 'Mozilla') === false) {
                        die('Access Denied: Suspicious Connection Header');
                }
        }

        /*
        Version 1.0 11 Jan 2013
        Author: Szczepan K
        http://www.szczepan.info
        me[@] szczepan [dot] info
        ###Description###
        A PHP function which can Block unwanted Requests to reduce your Website-Traffic.
        God for Spiders, Bots and annoying Clients.

        */
        function rate_limit_exceeded()
        {

                # Before using this function you must 
                # create & set this directory as writeable!!!!
                $dir = APP_UPLOAD_PATH;

                $rules   = array(
                        #You can add multiple Rules in a array like this one here
                        #Notice that large "sec definitions" (like 60*60*60) will blow up your client File
                        array(
                                //if >5 requests in 5 Seconds then Block client 15 Seconds
                                'requests' => 100, //5 requests
                                'sek' => 100, //5 requests in 5 Seconds
                                'blockTime' => 10 // Block client 15 Seconds
                        ),
                        array(
                                //if >10 requests in 30 Seconds then Block client 20 Seconds
                                'requests' => 140, //10 requests
                                'sek' => 200, //10 requests in 30 Seconds
                                'blockTime' => 50 // Block client 20 Seconds
                        ),
                        array(
                                //if >200 requests in 1 Hour then Block client 10 Minutes
                                'requests' => 500, //200 requests
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
                        $client = json_decode($file, true);
                } else {
                        $client                = array();
                        $client['time'][$time] = 0;
                }

                # Set/Unset Blocktime for blocked Clients
                if (isset($client['block'])) {
                        foreach ($client['block'] as $ruleNr => $timestampPast) {
                                $elapsed = $time - $timestampPast;
                                if (($elapsed) > $rules[$ruleNr]['blockTime']) {
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
                $file = file_put_contents($botFile, json_encode($client));


                return $blockIt;
        }
}
