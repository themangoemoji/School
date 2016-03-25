<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/20/16
 * Time: 11:05 PM
 */

$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Felis\LoginController($site, $_SESSION, $_POST);
header("location: " . $controller->getRedirect());