<?php

namespace Steampunked;


require __DIR__ . "/Player.php";
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 2/16/2016
 * Time: 8:37 PM
 */




class Model
{

    public function __construct($seed = null)
    {
        if ($seed === null) {
            $seed = time();
        }
        srand($seed);
        $this->playerTurn = new Player(1);
    }
    public function getSize() {
        return $this->gameSize;
    }
    // create the game board of 6x6,10x10, 20x20
    // images are 50x50 px
    public function setGame($size = 6, $player = 1) {
        $this->gameSize = $size;
        //$this->playerTurn = new Player($player);
        $this->playerTurn->changeTurn($player);
        // randomize images
    }
    public function changeTurn($turn) {
        $this->playerTurn->changeTurn($turn);
    }
    public function currentTurn() {
        return $this->playerTurn->getTurn();
    }

    private $playerTurn;
    private $rotation;
    private $gameSize;
    private $images;
}