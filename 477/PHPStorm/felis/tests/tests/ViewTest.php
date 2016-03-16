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

    /*
     * Testing the head function which contains:
     * <meta charset="utf-8">
     * <title>$this->title</title>
     * <meta name="viewport" content="width=device-width, initial-scale=1">
     * <link rel="stylesheet" href="lib/css/felis.css">
     */
    public function test_head() {
        $view = new Felis\View();

        $view->setTitle("Hey, Whaddup");
        $this->assertContains("<title>Hey, Whaddup</title>", $view->head());
        $this->assertNotContains("<title>viewporn</title>", $view->head());
        $this->assertContains("viewport", $view->head());
        $this->assertContains("meta charset=", $view->head());
        $this->assertContains("width=device-width", $view->head());
        $this->assertContains("b/css/felis.cs", $view->head());


    }


    /*
     * Test the Header and its contents
     **/
    public function test_header() {
        $view = new Felis\View();
        $view->setTitle("whatever");
        $html = $view->header();

        $this->assertContains('<nav>', $html);
        $this->assertContains('<ul class="left">', $html);
        $this->assertContains('<li><a href="./">The Felis Agency</a></li>', $html);
        $this->assertContains('</ul>', $html);
        $this->assertContains('</nav>', $html);
        $this->assertContains('<header class="main">', $html);
        $this->assertContains('<h1><img src="images/comfortable.png" alt="Felis Mascot"> whatever', $html);
        $this->assertContains('<img src="images/comfortable.png" alt="Felis Mascot"></h1>', $html);
        $this->assertContains('</header>', $html);

        $this->assertNotContains('<ul class="right">', $html);
    }

}


/// @endcond
?>
