<?php




/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/15/16
 * Time: 5:13 PM
 */
namespace Guessing;



class Guessing
{

    const MIN = 1;
    const MAX = 100;

    const UNDEFINED = 4;
    const TOOLOW = 3;
    const CORRECT = 1;
    const TOOHIGH = 2;
    const INVALID = 0;
    const UNDEFINED_START = 999;

    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
        $this->num_guesses = 0;
        $this->guess = Guessing::UNDEFINED_START;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return int
     */
    public function getNumGuesses()
    {
        return $this->num_guesses;
    }

    public function guess($guess) {
        $this->guess = $guess;
        if ( $this->guess < Guessing::MAX && $this->guess > Guessing::MIN ) {
            $this->num_guesses++;
        }
    }

    public function check()
    {
//        No guesses yet
        if ($this->guess == Guessing::UNDEFINED_START) {
            return Guessing::UNDEFINED;
        }

        elseif ( $this->guess > Guessing::MAX || $this->guess < Guessing::MIN ) {
            return Guessing::INVALID;
        }

        elseif ( $this->number == $this->guess ) {
            return Guessing::CORRECT;
        }

        elseif ( $this->number > $this->guess ) {
            return Guessing::TOOLOW;
        }

        elseif ( $this->number < $this->guess ) {
            return Guessing::TOOHIGH;
        }

    }

    /**
     * @return mixed
     */
    public function getGuess()
    {
        return $this->guess;
    }




    private $num_guesses;
    private $number;
    private $guess;
}