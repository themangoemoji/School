<?php

// require autoload file
require __DIR__ . "/../vendor/autoload.php";

// Start the PH session system
/* This will either find a new session assos w/ the client or create a new one
 * the session is stored in the global array $_SESSION*/
session_start();

/* We can name the location in $_SESSION where we are going to save the Wumpus
 * object because we reuse it
 **/
define("WUMPUS_SESSION", 'wumpus');

//Use Wumpus session if exists, otherwise create it
if(!isset($_SESSION[WUMPUS_SESSION])) {
    $_SESSION[WUMPUS_SESSION] = new \Wumpus\Wumpus(); // Seed: 1422668587
}

$wumpus = $_SESSION[WUMPUS_SESSION];


?>
