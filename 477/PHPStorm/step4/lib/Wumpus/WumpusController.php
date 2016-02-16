<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/8/16
 * Time: 4:01 PM
 */

namespace Wumpus;


class WumpusController
{

    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     * @param $request The $_REQUEST array
     */
    public function __construct(Wumpus $wumpus, $request) {
        $this->wumpus = $wumpus;
        if(isset($request['m'])) {
            $this->move($request['m']);
        } else if(isset($request['s'])) {
            $this->shoot($request['s']);
        } else if(isset($request['n'])) {
            // New game!
            $this->reset = true;
        } else if(isset($request['c'])) {
            $this->cheat();
        }



    }

    /** Move request
     * @param $ndx Index for room to move to */
    private function move($ndx) {
        // Simple error check
        if(!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }

        switch($this->wumpus->move($ndx)) {
            case Wumpus::HAPPY:
                break;

            case Wumpus::EATEN:
            case Wumpus::FELL:
                $this->reset = true;
                $this->page = 'lose.php';
                break;
        }
    }

    private function cheat() {
        $this->cheat = true;
    }


    /** Shoot request
     * @ndx Index for room to shoot to */
    private function shoot($ndx) {
        if(!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }

        if($this->wumpus->shoot($ndx)) {
            $this->reset = true;
            $this->page = 'win.php';
        }
        if ($this->wumpus->numArrows() <= 0) {
            $this->reset = true;
            $this->page = 'lose.php';
        }
    }



    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return boolean
     */
    public function isReset()
    {
        return $this->reset;
    }

    public function getCheat()
    {
        return $this->cheat;
    }         // True if we need to reset the game

    /* MEMBER VARIABLES */

    private $wumpus;                // The Wumpus object we are controlling
    private $page = 'game.php';     // The next page we will go to
    private $reset = false;
    private $cheat = false;



    /* ---------------- */
}