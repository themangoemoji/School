<?php
require '../lib/site.inc.php';

$controller = new Felis\ResetController($site, $_POST);
$redirect = $controller->getRedirect();
header("location: " . $redirect);
