<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,300italic,400italic,600italic,700italic,800italic,700|Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href="stylesheet.css" type="text/css" rel="stylesheet" />
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<div id="content">
    <?php echo present_header("Stalking the Wumpus"); ?>

    <p><img id="cave-picture" src="assets/dead-wumpus.jpg"></p>


    <h2 id="killed-wumpus-text">You killed the Wumpus</h2>
    <div>
        <h3 id="new-game-link"><a href="game.php">New Game</a></h3>
    </div>

</div>



</body>
</html>