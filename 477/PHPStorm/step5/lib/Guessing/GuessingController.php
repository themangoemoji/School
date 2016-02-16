<?php

namespace Guessing;

class GuessingController {
    /**
     * GuessingController constructor.
     * @param $guessing
     */
    public function __construct( $guessing, $post )
    {
        $this->guessing = $guessing;
        if(isset($post['clear'])) {
            $this->reset = true;
        }
        if(isset($post['value'])) {
            $this->guess($post['value']);
        }


//        if(isset($post['clear'])) {
//            $this->reset = true;
//        }
//        if(isset($request['g'])) {
//            $this->guess($request['g']);
//        }
    }


    public function guess($guess) {
        $this->guessing->guess($guess);
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




    private $guessing;                  // The guessing object we are controlling
    private $page = 'guessing.php';     // The next page we will go to
    private $reset = false;             // True if we need to reset the game
}