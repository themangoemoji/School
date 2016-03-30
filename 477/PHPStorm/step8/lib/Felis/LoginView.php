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

    private $e_tag = "no_error";
    /**
     * LoginView constructor.
     * @param $get
     * @param $session
     */
    public function __construct($session, $get)
    {
        $this->get = $get;
        $this->session = $session;
        if(isset($this->get['e'])) {
            $this->e_tag = strip_tags($this->get['e']);
        }

    }


    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional()
    {
//        If an error tag was found
        if ($this->e_tag == "") {
//            The user was not found for the session
            if (is_null($this->session['user'])) {
                $e_tag = "The user was not found for that email/password combination";
            }

        }

//        No problem logging in
        else {
            $e_tag = "";
        }

        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
<h3 class="error">$e_tag</h3>
HTML;


    }

}
