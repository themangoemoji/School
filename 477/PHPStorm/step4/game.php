<?php
require 'format.inc.php';
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step4</title>
    <link href="stylesheet.css" type="text/css" rel="stylesheet" />
</head>
<body>

<div id="content">
    <?php
        echo present_header("Stalking the Wumpus");
    ?>


    <p><img id="cave-picture" src="assets/cave.jpg" alt="picture of cave"></p>

    <div id="notifications">
        <?php
        echo $view->presentStatus();
        ?>
    </div>

    <div class="rooms">
        <?php
        echo $view->presentRoom(0);
        echo $view->presentRoom(1);
        echo $view->presentRoom(2);
        ?>
    </div>

    <?php
    echo $view->presentArrows();
    ?>

</div>

</body>
</html>