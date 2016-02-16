<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/8/16
 * Time: 11:51 AM
 */

function present_header($title) {
    $html = "<header>";
    $html .= "<nav><p><a href=\"welcome.php\">New Game</a> ";
    $html .= "<a href=\"game-post.php?n\">Game</a> ";
    $html .= "<a href=\"instructions.php\">Instructions</a></p></nav>";
    $html .= "<h1>$title</h1>";
    $html .= "</header>";

    return $html;
}

?>