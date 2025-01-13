<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . "/../core/load.php";

class TestMailModel extends TestCase
{
    public function testInternal()
    {
        $mails = new mailsModel();
        $r = $mails->internal('Test', 'test');
        $this->assertTrue($r);
    }
}
