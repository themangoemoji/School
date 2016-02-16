<?php
require 'format.inc.php';
require 'wumpus.inc.php';
$birds = 7;  // Room with the birds
$pits = array(3, 10, 13);    // Rooms with a bottomless pit
$room = 1; // The room we are in.
$cave = cave_array(); // Get the cave
$wumpus = 16;
$arrows = 3;
$arrow = -1;


if(isset($_GET['r']) && isset($cave[$_GET['r']]) ) {
    // We have been passed a room number
    $room = $_GET['r'];
    if(isset($_GET['a']) && isset($cave[$_GET['a']]) ) {
        $arrow = $_GET['a'];
        if ($arrow == 16) {
            header("Location: win.php");
            exit;
        }
    }

    // If we are adjacent to the birds
    if ($room == 7 ) {
        $room = 10;
    }

    // If we are adj to a pit
    if ($room == 3 || $room == 10 || $room == 13 || $room == 16) {
        header("Location: lose.php");
        exit;
    }

}
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

    <p><img id="cave-picture" src="assets/cave.jpg"></p>

    <div id="notifications">

        <?php

        echo '<p>' . date("g:ia l, F j, Y") . '</p>';


        if ($cave[$room][0] == 7 || $cave[$room][1] == 7 || $cave[$room][2] == 7) {
            echo "<p>&nbsp;You hear birds</p>";
        }

        if (in_array(3, $cave[$room])) {
            echo "<p>&nbsp;You feel a draft</p>";
        }
        if (in_array(10, $cave[$room])) {
            echo "<p>&nbsp;You feel a draft</p>";
        }
        if (in_array(13, $cave[$room])) {
            echo "<p>&nbsp;You feel a draft</p>";
        }

        // Look for wumpus
        // Return: 1 - adjacent; 2 - two away; 0 - none
        function find_wumpus($cave_arr, $room_num) {
            if (in_array(16, $cave_arr[$room_num])) {
                return 1;
            }

            else {
                for ($i = 0; $i < 3; $i++) {
                    $adj_cave = $cave_arr[$room_num][$i];
                    if (in_array(16, $cave_arr[$adj_cave])) {
                        return 2;
                    }
                }
            }
            return 0;
        }

        if (find_wumpus($cave, $room) == 1) {
            echo "<p>&nbsp;You smell a Wumpus</p>";
        }
        if (find_wumpus($cave, $room) == 2) {
            echo "<p>&nbsp;You smell a Wumpus</p>";
        }


        ?>



        <h2>You are in room <?php echo $room; ?></h2>

    </div>

    <br/>
    <div class="rooms">
        <div class="room">
            <img src="assets/cave2.jpg">
            <p><a href="game.php?r=<?php echo $cave[$room][0]; ?>">
                    <?php echo $cave[$room][0]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room . "&a=" . $cave[$room][0]; ?>">Shoot Arrow</a></p>
        </div><div class="room">
            <img src="assets/cave2.jpg">
            <p><a href="game.php?r=<?php echo $cave[$room][1]; ?>">
                    <?php echo $cave[$room][1]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room . "&a=" . $cave[$room][1]; ?>">Shoot Arrow</a></p>
    </div><div class="room">
            <img src="assets/cave2.jpg">
            <p><a href="game.php?r=<?php echo $cave[$room][2]; ?>">
                    <?php echo $cave[$room][2]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room . "&a=" . $cave[$room][2]; ?>">Shoot Arrow</a></p>
    </div>
    </div>

    <h2>You have <?php echo $arrows; ?> arrows remaining.</h2>

</div>

</body>
</html>