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

    private $title = "";	///< The page title
}