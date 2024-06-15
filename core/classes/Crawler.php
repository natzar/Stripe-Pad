<?

/*
 *
 *	CRAWLER - Database crawler_queue + domains
 *
 *
 *
 *
 *
 *
 *
*/



Class Crawler {

    var $domain = null;
    var $sitemap = array();
    var $queue = array();
    var $visited = array();
    var $externalLinks = false;
    var $data = array();
    var $limit = 30;
    var $counter = 0;

    function __construct(){

    }

    function visit($url,$limit = 30){
        $this->domain = $url;    
        $this->limit = $limit;
        $this->process($this->domain);
        
        
        while (!empty($this->queue) and $this->counter < $this->limit){
            $this->process($this->queue[0]);
        }

        return $this->data;
    }

    function process($url){        

        if (count($this->visited) > $this->limit){
            $this->queue = array();
            return;
        }
       
        $web = new Webpage($url);
        $links = $web->getLinks();  
        $this->handleWebpage($web);
        $this->visited[] = $url;
        $this->addToQueue($links);
        array_shift($this->queue);
        $this->counter++;
        

        // Find broken links
        // Code Response
        // Page Views from google analytis
    
    }
    function saveData($data){
        $this->data[] = $data;
    }
    function handleWebpage($web){
        $this->saveData(array("url" => $web->url,"http_code" => $web->getHttpCode(),"seo" => $web->getAllInterestingSEOElements(),"ttfb" => $web->data['connection']['total_time']));
    }

    
    function addToQueue($urls){
        foreach($urls as $url){
            $url = $this->fixUrl($url);
            if (!empty($url) and !in_array($url,$this->queue) and !in_array($url, $this->visited)){
                if ($this->validUrl($url)){
                    

                    if ($this->externalLinks){
                        $this->queue[] = $url;
                    }else{
                        if (!strstr($url,$this->domain)){

                        }else{
                            $this->queue[] = $url;
                        }
                    }
                }
                
            }
        }
        //echo "Queue: ".count($this->queue);
    }
    function fixUrl($url){
        if (substr($url, 0, 2) == "//"){
            $url = "http:".$url;
        } else if (substr($url,0,1) == "/"){
            $url = $this->domain.$url;
        }
        return $url;
    }
    function validUrl($url){
        $valid = false;
        if (substr($url,0,4) == "http"){
            return true;
        }

        return $valid;
    }


}

