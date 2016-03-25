<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class SiteTest extends \PHPUnit_Framework_TestCase
{

	private static $site;

	public static function setUpBeforeClass() {
		self::$site = new Felis\Site();
		$localize  = require 'localize.inc.php';
		if(is_callable($localize)) {
			$localize(self::$site);
		}
	}



	public function test_construction() {
		$db = new \Felis\Site();

		$db->dbConfigure("myhost","myuser","mypass","myprefix");
		$db->setRoot("myroot");
		$this->assertEquals($db->getRoot("myroot"), "myroot");
		$db->setEmail("myemail");
		$this->assertEquals($db->getEmail("myemail"), "myemail");
		$this->assertEquals($db->getTablePrefix("myprefix"), "myprefix");



//		$this->assertEquals($db->getEmail());
	}

	public function test_localize() {
		$site = new Felis\Site();
		$localize = require 'localize.inc.php';
		if(is_callable($localize)) {
			$localize($site);
		}
		$this->assertEquals('test8_', $site->getTablePrefix());
	}


}

/// @endcond
?>
