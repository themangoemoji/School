<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class CasesTest extends \PHPUnit_Framework_TestCase
{
	private static $site;

	public static function setUpBeforeClass() {
		self::$site = new Felis\Site();
		$localize  = require 'localize.inc.php';
		if(is_callable($localize)) {
			$localize(self::$site);
		}
	}


	/**
	 * Test to ensure Cases::get is working.
	 */
	public function test_get() {
		$cases = new Felis\Cases(self::$site);

		$case = $cases->get(22);
		$this->assertInstanceOf('Felis\ClientCase', $case);

		$this->assertEquals(22, $case->getId());
		$this->assertEquals(9, $case->getClient());
		$this->assertEquals(8, $case->getAgent());
		$this->assertEquals("Owen, Charles", $case->getAgentName());
		$this->assertEquals("Simpson, Bart", $case->getClientName());
		$this->assertEquals("case summary", $case->getSummary());
		$this->assertEquals(Felis\ClientCase::STATUS_OPEN, $case->getStatus());
		$this->assertEquals("16-9876", $case->getNumber());
	}
}

/// @endcond
?>
