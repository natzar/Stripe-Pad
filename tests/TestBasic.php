<?php

use PHPUnit\Framework\TestCase;

//require_once dirname(__FILE__) . "/../sp-load.php";

class TestBasic extends TestCase
{
    public function testCMS()
    {
        $aux = 1;
        $this->assertEquals(1, $aux);
    }
}
