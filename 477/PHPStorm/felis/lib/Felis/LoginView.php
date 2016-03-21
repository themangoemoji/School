<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/20/16
 * Time: 11:35 PM
 */

namespace Felis;


class LoginView extends HomeView
{

    private $session;
    private $get;

    /**
     * LoginView constructor.
     * @param $get
     * @param $session
     */
    public function __construct($get, $session)
    {
        $this->get = $get;
        $this->session = $session;
    }


    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional()
    {
        if ($this->get['e']) {

            return <<<HTML
<h1>NOOO!!!</h1>
<p><a href="">Learn more</a></p>
HTML;
        }

        else {
            return <<<HTML
<h1>OHHH YEAAAH!!!</h1>
<p><a href="">Learn more</a></p>
HTML;
        }

    }

}
