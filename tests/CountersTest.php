<?php



use PHPUnit\Framework\TestCase;

//require_once dirname(__FILE__) . "/../sp-load.php";

class TestCounters extends TestCase
{
	public function testCountersAreWorking()
	{
		$counters = new CountersModel('agent', 1);
		$this->assertInstanceOf(CountersModel::class, $counters);
		//$this->assertEquals('agent', $counters->getType());
		//$this->assertEquals(1, $counters->getRid());
	}
}
