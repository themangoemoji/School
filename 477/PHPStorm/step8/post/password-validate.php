<?php
require '../lib/site.inc.php';

$controller = new Felis\PasswordValidateController($site, $_POST, $_SESSION);
header("location: " . $controller->getRedirect());


/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/