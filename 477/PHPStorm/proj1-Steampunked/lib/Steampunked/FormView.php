<?php

/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/17/16
 * Time: 1:50 PM
 */


namespace Steampunked;


class FormView
{

    /**
     * FormView constructor.
     * @param $steampunked_model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function present() {
        // Add form to welcome page
        $html = '<form method="post" action="model-post.php">';

//        Add welcome header and image
        $html .= <<<HTML
<h1>Hello, Steampunked!</h1>
<img src=""
HTML;

        return $html;

    }

    private $model;

}
