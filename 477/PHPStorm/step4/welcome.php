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


    <p><img id="cave-picture" src="assets/resumegif.png" alt="cavepic yo"></p>


    <h2 id="welcome-text">Welcome to <span>Stalking the Wumpus</span></h2>
    <div id="welcome-links">
        <h3><a href="instructions.php">Instructions</a></h3>
        <h3><a href="game-post.php?n">Start Game</a></h3>
    </div>

</div>

</body>
</html>