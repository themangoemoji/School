<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/20/16
 * Time: 3:24 PM
 */

/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('wrigh517@cse.msu.edu');
    $site->setRoot('/~wrigh517/step7');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=wrigh517',
        'wrigh517',       // Database user
        'Cw3s5Cbf6wZCeG8a',     // Database password
        'test_');            // Table prefix

};