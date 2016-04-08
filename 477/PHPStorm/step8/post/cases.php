<?php
require '../lib/site.inc.php';

$controller = new Felis\CasesController($site, $_POST);
header("location: " . $controller->getRedirect());

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/