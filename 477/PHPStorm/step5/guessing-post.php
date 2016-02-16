<?php
require __DIR__ . '/lib/guessing.inc.php';
$controller = new Guessing\GuessingController($guessing, $_POST);

// Get the _POST tag vals
$guess = strip_tags($_POST['value']);

//Get the _POST tag vals
$clear = strip_tags($_POST['clear']);

if(isset($_SESSION['clear'])) {
    $this->reset = true;
}
if(!isset($_SESSION['value'])) {
    $_SESSION['value'] = $guess;
} else {
    $_SESSION['value'] = $guess;
}

if($controller->isReset()) {
    unset($_SESSION[GUESSING_SESSION]);
}

header("location: guessing.php");
exit;