<?php

use PHPUnit\Framework\TestCase;



class TestMailModel extends TestCase
{
    // public function testInternal()
    // {
    //     $mails = new mailsModel();
    //     $r = $mails->internal('Test', 'test');
    //     $this->assertTrue($r);
    // }

    public function testWelcome()
    {
        require_once dirname(__FILE__) . "/../core/sp-load.php";
        $mails = new mailsModel();

        # Send welcome email
        $data = array("email" => 'test@example.com', "name" => 'Mr New User', "password" => 'xXFakeXx');
        $subject = "[INFO] Welcome to " . APP_NAME;
        $r = $mails->sendTemplate('welcome_user', $data, "beto.phpninja@gmail.com", $subject);

        //$r = $mails->internal('Test', 'test');
        $this->assertTrue($r);
        $mails = null;
    }
}
