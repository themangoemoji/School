<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/8/16
 * Time: 1:16 PM
 */

namespace Wumpus;


class WumpusView
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     */
    public function __construct(Wumpus $wumpus) {
        $this->wumpus = $wumpus;
    }

    /** Generate the HTML for the number of arrows remaining */
    public function presentArrows() {
        $a = $this->wumpus->numArrows();
        return "<p>You have $a arrows remaining.</p>";
    }


    /** Generate the HTML for the room status
     *  this will be rendered in game.php
     */
    public function presentStatus() {
        $room = $this->wumpus->getCurrent()->getNum();

//        The html we are returning to the game.php
        $html = "<p>You are in room $room</p>";

        if ($this->wumpus->getCurrent()->contains(Wumpus::WUMPUS, 2) ) {
            $html .= "<p>You smell a wumpus.</p>";
        }
        if ($this->wumpus->getCurrent()->contains(Wumpus::BIRDS, 1) ) {
            $html .= "<p>You hear birds.</p>";
        }
        if ($this->wumpus->getCurrent()->contains(Wumpus::PIT, 1) ) {
            $html .= "<p>You feel a draft.</p>";
        }
        if ($this->wumpus->wasCarried()) {
            $carriedRoom = $this->wumpus->getCurrent()->getNum();
            $html .= "<p>You were carried by the birds to room $carriedRoom.</p>";
        }

        return $html;
    }

    /** Present the links for a room
     * @param $ndx An index 0 to 2 for the three rooms */
    public function presentRoom($ndx) {
        $room = $this->wumpus->getCurrent()->getNeighbors()[$ndx];
        $roomnum = $room->getNum();
        $roomndx = $room->getNdx();
        $roomurl = "game-post.php?m=$roomndx";
        $shooturl = "game-post.php?s=$roomndx";

        $html = <<<HTML
<div class="room">
  <figure><img src="assets/cave2.jpg" width="180" height="135" alt=""/></figure>
  <p><a href="$roomurl">$roomnum</a></p>
<p><a href="$shooturl">Shoot Arrow</a></p>
</div>
HTML;

        return $html;
    }

    private $wumpus;    // The Wumpus object

}