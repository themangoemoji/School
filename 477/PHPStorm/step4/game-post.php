<?php
require 'lib/game.inc.php';
$controller = new Wumpus\WumpusController($wumpus, $_REQUEST);

if ($controller->getCheat()) {
    $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus(1422668587);
}

if ($controller->isReset()) {
    unset($_SESSION[WUMPUS_SESSION]);
}

//echo "<p>" . $controller->getPage() . "</p>";
header('Location: ' . $controller->getPage());
