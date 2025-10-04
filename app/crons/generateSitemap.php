<?php

include "../core/sp-load.php";

$a = array();
$b = array();

foreach ($a as $c):
    foreach ($b as $t):
        //foreach($time as $a):
        echo '
<url>
  <loc>' . HOMEPAGE_URL . $c . '/' . $t . '/' . $t . '-in-' . $c . '-' . $a . '</loc>
  <priority>1.00</priority>' . PHP_EOL;

        echo '<changefreq>monthly</changefreq>';


        echo '</url>' . PHP_EOL;
    //endforeach;
    endforeach;
endforeach;
