<?php

require __DIR__ . "/../vendor/autoload.php";



// Start the PHP session system
session_start();

// define a GUESS session.
define("MODEL_SESSION", 'model');


// If there is a /**/Steampunked session, use that. Otherwise, create one
if(!isset($_SESSION[MODEL_SESSION])) {
    $_SESSION[MODEL_SESSION] = new Steampunked\Model();
}

$model = $_SESSION[MODEL_SESSION];

?>