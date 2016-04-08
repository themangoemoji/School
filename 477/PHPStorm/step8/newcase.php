<?php
require 'lib/site.inc.php';
$view = new Felis\NewCaseView($site, $_GET, $_SESSION);
if(!$view->protect($site, $user)) {
	header("location: " . $view->getProtectRedirect());
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Felis New Case</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/css/felis.css">
</head>

<body>
<div class="case">
<!--<nav>
	<ul class="left">
		<li><a href="./">The Felis Agency</a></li>
	</ul>
	<ul class="right">
		<li><a href="staff.php">Staff</a></li>
		<li><a href="cases.php">Cases</a></li>
		<li><a href="./">Log out</a></li>
	</ul>
</nav>-->



<?php
echo $view->header();
echo $view->error();
echo $view->present();
echo $view->footer();
?>

</div>

</body>
</html>
