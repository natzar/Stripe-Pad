<?php

use PHPUnit\Framework\TestCase;



class TestSystem extends TestCase
{
    // public function testInternal()
    // {
    //     $mails = new mailsModel();
    //     $r = $mails->internal('Test', 'test');
    //     $this->assertTrue($r);
    // }

    public function testEncryption()
    {
        require_once dirname(__FILE__) . "/../core/sp-load.php";

        echo encrypt('w2YXk6uJF1M8Y7gY');

        echo "==\n";
        echo encrypt('9E6rM6e5t1yy7zDP');
        $x = encrypt('beto');
        $this->assertTrue(decrypt($x) == 'beto');
    }
}
