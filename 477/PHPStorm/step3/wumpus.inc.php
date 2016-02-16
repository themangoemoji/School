<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/2/16
 * Time: 2:02 PM
 */

/**
 * Create an array that represents the cave
 * @returns Array
 */
function cave_array() {
    $cave = array(
        1 => array(5, 6, 2),
        2 => array(1, 8, 3),
        3 => array(4, 10, 2),
        4 => array(3, 12, 5),
        5 => array(5, 4, 1),
        6 => array(1, 15, 7),
        7 => array(6, 16, 8),
        8 => array(7, 2, 9),
        9 => array(8, 10, 17),
        10 => array(3, 9, 11),
        11 => array(10, 18, 12),
        12 => array(4, 11, 13),
        13 => array(12, 19, 14),
        14 => array(5, 13, 15),
        15 => array(20, 14, 6),
        16 => array(7, 20, 17),
        17 => array(18, 9, 16),
        18 => array(11, 17, 19),
        19 => array(13, 18, 20),
        20 => array(19, 16, 15)
    );

    return $cave;
}

?>