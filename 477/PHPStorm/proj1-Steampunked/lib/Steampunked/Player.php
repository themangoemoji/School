<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 2/17/2016
 * Time: 2:51 PM
 */

namespace Steampunked;


class Player
{
    private $turn;
    public function __construct($p = 1)
    {
        $this->turn = $p; // set starting turn

    }
    public function changeTurn($t) {
//        if ($this->turn == 1) {
//            $this->turn = 2;
//        } else {
//            $this->turn = 1;
//        }
        $this->turn = $t;

    }
    public function getTurn() {
        return $this->turn;
    }
}