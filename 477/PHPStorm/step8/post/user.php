<?php
require '../lib/site.inc.php';

$controller = new Felis\UserController($site, $_POST, $_SESSION, $_GET);
header("location: " . $controller->getRedirect());


/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/