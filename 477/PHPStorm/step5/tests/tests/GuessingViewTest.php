<?php

require __DIR__ . "/../../vendor/autoload.php";

use Guessing\GuessingView as GuessingView;
use Guessing\Guessing as Guessing;


/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class GuessingViewTest extends \PHPUnit_Framework_TestCase
{
	const SEED = 1234;

	public function test_construct() {
		$guessing = new Guessing(self::SEED);
		$this->assertEquals(23, $guessing->getNumber());

		$guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();

        // Make sure the header is there
		$this->assertContains("<h1>Guessing Game</h1>", $guessingViewString);
        $this->assertContains("Try to guess the number.", $guessingViewString);
        $this->assertContains("New Game", $guessingViewString);


        // Make sure nothing is weird with the header
        $this->assertNotContains("<h1>Guesing Game</h1>", $guessingViewString);


//        An invalid guess
        $guessing->guess(0);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertContains("Your guess of 0 is invalid!", $guessingViewString);

        $guessing->guess(-200);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertContains("Your guess of -200 is invalid!", $guessingViewString);

        $guessing->guess(200);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertContains("Your guess of 200 is invalid!", $guessingViewString);


        $guessing->guess(23);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertContains("After 1 guesses you are correct!", $guessingViewString);

        $guessing->guess(24);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertNotContains("After 2 guesses you are correct!", $guessingViewString);

        $guessing->guess(23);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertContains("After 3 guesses you are correct!", $guessingViewString);

        $guessing->guess(24);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertContains("After 4 guesses you are too high!", $guessingViewString);


        $guessing->guess(22);
        $guessingView = new GuessingView($guessing);
        $guessingViewString = $guessingView->present();
        // Make sure the header is there
        $this->assertContains("After 5 guesses you are too low!", $guessingViewString);


	}
}

/// @endcond
?>
