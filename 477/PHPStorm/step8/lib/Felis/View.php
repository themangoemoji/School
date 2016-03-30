<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/16/16
 * Time: 2:09 AM
 */

namespace Felis;


class View
{
/*     Begin Member Variables
  --------------------------*/

    protected $site;		///< The Site object
    protected $session;		///< $_SESSION
    protected $get;			///< $_GET

    protected $redirect = null;	///< Optional redirect?

    private $title = "";	///< The page title
    private $links = array();	///< Links to add to the nav bar
    private $protectRedirect = null;


    const SESSION_ERROR = "felis_error";


    /**
     * View constructor.
     * @param array $get $_GET
     * @param array $session $_SESSION
     */
    public function __construct(Site $site, array $get, array $session) {
        /*
         * When I found that several pages needed $_GET and $_SESSION
         * and error message handling, I found it easiest to just move
         * that into the View base class.
         */
        $this->site = $site;
        $this->get = $get;
        $this->session = $session;
    }
/*------------------------
    End Member Variables*/



//  --------------------------
//      Begin Member Functions



    /**
     * Create the HTML for the page footer
     * @return string HTML for the standard page footer
     */
    public function footer()
    {
        return <<<HTML
<footer><p>Copyright © 2016 Felis Investigations, Inc. All rights reserved.</p></footer>
HTML;
    }


    /**
     * Set the page title
     * @param $title New page title
     */
    public function setTitle($title) {
        $this->title = $title;
    }


    /**
     * Create the HTML for the contents of the head tag
     * @return string HTML for the page head
     */
    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>$this->title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="lib/css/felis.css">
HTML;
    }


    /**
     * Create the HTML for the page header
     * @return string HTML for the standard page header
     */
    public function header() {
        $additional = $this->headerAdditional();

        $html = <<<HTML
<nav>
    <ul class="left">
        <li><a href="./">The Felis Agency</a></li>
    </ul>
HTML;


        if(count($this->links) > 0) {
            $html .= '<ul class="right">';
            foreach($this->links as $link) {
                $html .= '<li><a href="' .
                    $link['href'] . '">' .
                    $link['text'] . '</a></li>';
            }
            $html .= '</ul>';
        }


        $html .= <<<HTML
</nav>
<header class="main">
    <h1><img src="images/comfortable.png" alt="Felis Mascot"> $this->title
    <img src="images/comfortable.png" alt="Felis Mascot"></h1>
    $additional
</header>
HTML;
        return $html;
    }


    /**
     * Add a link that will appear on the nav bar
     * @param $href What to link to
     * @param $text
     */
    public function addLink($href, $text) {
        $this->links[] = array("href" => $href, "text" => $text);
    }


    /**
     * Override in derived class to add content to the header.
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return '';
    }


    /**
     * Protect a page for staff only access
     *
     * If access is denied, call getProtectRedirect
     * for the redirect page
     * @param $site The Site object
     * @param $user The current User object
     * @return bool true if page is accessible
     */
    public function protect($site, $user) {
        if($user->isStaff()) {
            return true;
        }

        $this->protectRedirect = $site->getRoot() . "/";
        return false;
    }

    /**
     * Get any redirect page
     */
    public function getProtectRedirect() {
        return $this->protectRedirect;
    }


    /**
     * Get any optional error messages
     * @return string Optional error message HTML or empty if none.
     */
    public function errorMsg() {
        if(isset($this->get['e']) && isset($this->session[self::SESSION_ERROR])) {
            return '<p class="error">' . $this->session[self::SESSION_ERROR] . '</p>';
        } else {
            return '';
        }
    }

    public function error() {
$error = $this->errorMsg();
        return <<<HTML
<h3 class="error">$error</h3>
HTML;
    }

/*--------------------
End Member Functions*/

}