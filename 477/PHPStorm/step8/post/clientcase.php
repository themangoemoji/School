<?php

require '../lib/site.inc.php';

$controller = new Felis\ClientCaseController($site, $_POST, $_GET);
header("location: " . $controller->getRedirect());


/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/