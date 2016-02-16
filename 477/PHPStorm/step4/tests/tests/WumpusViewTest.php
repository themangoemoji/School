<?php

require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class WumpusViewTest extends \PHPUnit_Framework_TestCase
{
	public function test1() {
		//$this->assertEquals($expected, $actual);
	}

	public function test_construct() {
		$wumpus = new Wumpus\Wumpus(self::SEED);
		$view = new Wumpus\WumpusView($wumpus);

		$this->assertInstanceOf('Wumpus\WumpusView', $view);
	}

    public function test_presentArrows() {
        $wumpus = new Wumpus\Wumpus(self::SEED);
        $view = new Wumpus\WumpusView($wumpus);

        $arrows = $view->presentArrows();
        $this->assertContains('<p>You have 3 arrows remaining.</p>', $arrows);
    }


    public function test_presentStatus() {
        $wumpus = new Wumpus\Wumpus(self::SEED);
        $view = new Wumpus\WumpusView($wumpus);

        $status = $view->presentStatus();
        $this->assertContains('You are in room 11', $status, "37");
        $this->assertContains("smell a wumpus", $status, "38");
        $this->assertNotContains("carried by the birds", $status, "39");
        $this->assertNotContains("feel a draft", $status, "40");
        $this->assertNotContains("hear birds", $status, "41");

        $wumpus->move(20);
        $status = $view->presentStatus();
        $this->assertNotContains("smell a wumpus", $status, "42");
        $this->assertNotContains("carried by the birds", $status, "43");
        $this->assertContains("feel a draft", $status, "44");
        $this->assertContains("hear birds", $status, "45");

        $wumpus->move(19);
        $status = $view->presentStatus();
        $this->assertContains("carried by the birds", $status, "52");
    }

    public function test_presentRoom() {
        $wumpus = new Wumpus\Wumpus(self::SEED);
        $view = new Wumpus\WumpusView($wumpus);

        $room = $view->presentRoom(0);
        $this->assertContains('?m=3">6', $room);
        $this->assertContains('?s=3">Shoot', $room);

        $room = $view->presentRoom(1);
        $this->assertContains('?m=9">1', $room);
        $this->assertContains('?s=9">Shoot', $room);

        $room = $view->presentRoom(2);
        $this->assertContains('?m=11">5', $room);
        $this->assertContains('?s=11">Shoot', $room);
    }

    const SEED = 1422668587;


}


/// @endcond
?>
