<?php
require 'format.inc.php';
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step 4</title>
    <link href="stylesheet.css" type="text/css" rel="stylesheet" />
</head>
<body>

<div id="content">

    <?php
    echo present_header("Stalking the Wumpus");
    ?>


    <p><img id="cave-picture" src="assets/dead-wumpus.jpg" alt="cave pic yo"></p>


    <h2 id="killed-wumpus-text">You killed the Wumpus</h2>
    <div>
        <h3 id="new-game-link"><a href="game.php">New Game</a></h3>
    </div>

</div>



</body>
</html>