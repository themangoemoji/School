<?php

require __DIR__ . "/../vendor/autoload.php";

/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/15/16
 * Time: 5:46 PM
 */
session_start(); // _$SESSION

define("GUESSING_SESSION", 'guessing');

if(!isset($_SESSION[GUESSING_SESSION])) {
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing();
}

if(isset($_GET['seed'])) {
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing(strip_tags($_GET['seed']));
}

$guessing = $_SESSION[GUESSING_SESSION];

?>