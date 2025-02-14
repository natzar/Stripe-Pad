<?php

$tags = array("happy-hour","free-stuff-to-do","things-to-do","concerts-and-live-music","what-to-do-with-kids","sports-events","art-exhibitions","street-markets","meetups-and-events");

$cities = array("madrid","berlin","paris","london","barcelona","miami","new-york","san-francisco","los-angeles");
$time = array("today","tomorrow","friday","saturday","sunday","this-weekend");
foreach($cities as $c):
	foreach($tags as $t):
	    //foreach($time as $a):
echo '
<url>
  <loc>https://www.airovic.com/'. $c .'/'.$t.'/'. $t .'-in-'. $c .'-'.$a.'</loc>
  <priority>1.00</priority>'.PHP_EOL;
  if ($a == "friday" or $a == "saturday" or $a == "sunday" or $a == "this-weekend"){
      echo '<changefreq>weekly</changefreq>';
  }else{
      echo '<changefreq>daily</changefreq>';
  }
     
echo '</url>'.PHP_EOL;
//endforeach;
endforeach;
endforeach;