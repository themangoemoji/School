<?php
require '../lib/site.inc.php';

$controller = new Felis\UsersController($site, $user, $_POST);
header("location: " . $controller->getRedirect());

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/