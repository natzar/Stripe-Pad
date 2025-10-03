<?php



use PHPUnit\Framework\TestCase;

//require_once dirname(__FILE__) . "/../sp-load.php";

class TestEmailValidator extends TestCase
{
    public function testEmailCanValidate()
    {
        $v = new EmailValidator();
        $this->assertTrue($v->isValid('hello@go.com'));
        $this->assertFalse($v->isValid('no-reply@domain.com'));
    }
}
