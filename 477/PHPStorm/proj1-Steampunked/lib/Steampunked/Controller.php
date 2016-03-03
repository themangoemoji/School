<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 2/16/16
 * Time: 9:43 PM
 */

namespace Steampunked;

class ModelController
{
    private $reset = false;
    private $model;

    public function __construct(Model $model, $post) {
        $this->model = $model;

//        if(isset($post['value'])) {
//
//            $this->guessing->guess(strip_tags($post['value']));
//
//        } else if(isset($post['clear'])) {
//            $this->reset = true;
//        }
    }

    public function isReset(){
        return $this->reset;
    }

}