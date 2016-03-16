<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class ViewTest extends \PHPUnit_Framework_TestCase
{
	public function test1() {
		//$this->assertEquals($expected, $actual);
	}

	public function test_footer() {
		$view = new Felis\View();

		$this->assertContains('<footer><p>Copyright © 2016 Felis Investigations, Inc. All rights reserved.</p></footer>',
			$view->footer());
	}

    public function test_head() {
        $view = new Felis\View();

        $view->setTitle("Hey, Whaddup");
        $this->assertContains("<title>Hey, Whaddup</title>", $view->head());
    }

}


/// @endcond
?>
