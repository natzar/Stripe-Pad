<?
#
# 1. A robot may not injure a human being or, through inaction, allow a
# human being to come to harm.
#
# 2. A robot must obey orders given it by human beings except where such
# orders would conflict with the First Law.
#
# 3. A robot must protect its own existence as long as such protection
# does not conflict with the First or Second Law.


class Request {
    var $args;
    var $keyword;
    var $name;
    var $job;
    var $results; 
    var $output;
    
    
     function wget($url){
         //   echo PHP_EOL."Wget ".$url.PHP_EOL;
            //$url = 'https://api.vineapp.com/channels/featured';
            if ($html = @file_get_contents($url)){
                return $html;
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);      
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            //curl_setopt($ch, CURLOPT_REFERER, 'https://www.phpninja.info/');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); 
//curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20); //timeout in seconds
            

            $certificate_location = dirname(__FILE__).'/../../cacert.pem';
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_CAINFO, $certificate_location);

            //curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
    
            // BOT
            $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.9999.999 Safari/537.36';
			curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

            //$userAgent = "PhpNinjaBot/1.0 (+https://phpninja.es/bot-info)";
            //curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

            $result = curl_exec($ch);
            if (!$result)
            {
                return array("error" => true, "message" => curl_error($ch));
            }
            else
            {
                return $result;
            }

            curl_close($ch);
    }  

    function wget_info_deprecated($url){
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //    $UAGENT = new UAgent();        
        //   curl_setopt($ch, CURLOPT_USERAGENT, $UAGENT->random_uagent());
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $certificate_location = dirname(__FILE__).'/../../cacert.pem';
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_CAINFO, $certificate_location);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);  
        // curl_setopt($ch, CURLOPT_CAINFO, '/path/to/server.crt');  

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); // set browser/user agent    
        //curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'read_header');

        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('vine-session-id: '.$this->vineKey));
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
        //curl_setopt($ch, CURLOPT_CAINFO, '/path/to/cert/file/cacert.pem');          
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        ///   curl_setopt ($ch, CURLOPT_CAINFO, "cacert.pem");
        $result = curl_exec($ch);
        if (!$result)
        {
               return array("error" => true, "message" => curl_error($ch));
        }
        else
        {
                return curl_getinfo($ch);
        }

        curl_close($ch);

    }

    function wget_combi($url){ // info + content
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      

         //   $UAGENT = new UAgent();        
         //   curl_setopt($ch, CURLOPT_USERAGENT, $UAGENT->random_uagent());
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
            
            $certificate_location = dirname(__FILE__).'/../../cacert.pem';
      //      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_CAINFO, $certificate_location);
     curl_setopt($ch, CURLOPT_HEADER, 1);
    //        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
           // curl_setopt($ch, CURLOPT_CAINFO, '/path/to/server.crt');  

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.9999.999 Safari/537.36';
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);


            //curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'read_header');

           // curl_setopt($ch, CURLOPT_HTTPHEADER, array('vine-session-id: '.$this->vineKey));
            //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
            //curl_setopt($ch, CURLOPT_CAINFO, '/path/to/cert/file/cacert.pem');          
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         ///   curl_setopt ($ch, CURLOPT_CAINFO, "cacert.pem");
            $response = curl_exec($ch);
            $info =  curl_getinfo($ch);
            $header_size = $info['header_size'];

            $headers = substr($response, 0, $header_size);
            $html = substr($response, $header_size);

            if (!$response)
            {
                    return array("error" => true, "message" => curl_error($ch));
            }
            else
            {
                    return array("response" => $html, "info" => $info, "headers" => $headers);
            }
    
            curl_close($ch);
    }

}
