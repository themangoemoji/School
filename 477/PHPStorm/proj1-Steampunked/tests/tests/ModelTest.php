<?php
require __DIR__ . "/../../vendor/autoload.php";
use Steampunked\Model as Model;
/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
	const SEED = 1234;
	/*
	 * The class constructs without error.
	 *You can create a game of a given size.
	 *The getters for the size work.
	 *You can choose a player turn and choose a new turn.
	 */
	public function test_construct(){
		$model = new Model(self::SEED);
//		$this->assertInternalType("Steampunked",$model);
	}
	public function test_game() {
		$model = new Model(self::SEED);
		$model->setGame(6,1);
		$this->assertEquals(6,$model->getSize());
		$this->assertEquals(1,$model->currentTurn());
		$model->setGame(10,2);
		$this->assertEquals(10,$model->getSize());
		$this->assertEquals(2,$model->currentTurn());
	}
	public function test_size() {
		$model = new Model(self::SEED);
		$model->setGame(6);
		$this->assertEquals(6,$model->getSize());
		$model->setGame();
		$this->assertEquals(6,$model->getSize());
		$model->setGame(10);
		$this->assertEquals(10,$model->getSize());
		$model->setGame(6,2);
		$this->assertEquals(6,$model->getSize());


	}
	public function test_turn() {
		$model = new Model(self::SEED);
		$model->setGame();
		$this->assertEquals(1,$model->currentTurn());
		$model->changeTurn(2);
		$this->assertEquals(2,$model->currentTurn());

	}
}

/// @endcond
?>
