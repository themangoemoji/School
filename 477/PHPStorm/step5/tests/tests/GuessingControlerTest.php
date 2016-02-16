<?php

require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
// This allows us to use just Guessing
// instead of Guessing\Guessing
use Guessing\Guessing as Guessing;
use Guessing\GuessingController as Controller;

/** @file
 * Unit tests for the class Guessing
 */
class GuessingControlerTest extends \PHPUnit_Framework_TestCase {
	const SEED = 1234;

	public function test_reset() {
		$guessing = new Guessing(self::SEED);
		$controller = new Controller($guessing, array('value' => 12));
		$this->assertFalse($controller->isReset());

		$guessing = new Guessing(self::SEED);
		$controller = new Controller($guessing, array('clear' => 'New Game'));
		$this->assertTrue($controller->isReset());

	}

    public function test_win() {

        $guessing = new Guessing(self::SEED);
        $controller = new Controller($guessing, array('value' => 12));

        $this->assertFalse($controller->isReset());

        $controller = new Controller($guessing, array('value' => 23));
        $this->assertEquals($guessing->check(), Guessing::CORRECT, "Guessing correctly");

        $controller = new Controller($guessing, array('value' => 25));
        $this->assertNotEquals($guessing->check(), Guessing::CORRECT, "Too High");

        $controller = new Controller($guessing, array('value' => 25));
        $this->assertEquals($guessing->check(), Guessing::TOOHIGH, "Too High");

        $controller = new Controller($guessing, array('value' => 20));
        $this->assertEquals($guessing->check(), Guessing::TOOLOW, "Too Low");

        $controller = new Controller($guessing, array('value' => 0));
        $this->assertEquals($guessing->check(), Guessing::INVALID, "Too Low, Invalid");

        $controller = new Controller($guessing, array('value' => 1));
        $this->assertNotEquals($guessing->check(), Guessing::INVALID, "Min");

        $controller = new Controller($guessing, array('value' => 100));
        $this->assertNotEquals($guessing->check(), Guessing::INVALID, "Max");

        $controller = new Controller($guessing, array('value' => 101));
        $this->assertEquals($guessing->check(), Guessing::INVALID, "Max");

        $controller = new Controller($guessing, array('value' => 0));
        $this->assertEquals($guessing->check(), Guessing::INVALID, "Max");
    }


}
?>
