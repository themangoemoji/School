<?php
require '../lib/site.inc.php';

$controller = new Felis\NewCaseController($site, $user, $_POST, $_SESSION);
header("location: " . $controller->getRedirect());
