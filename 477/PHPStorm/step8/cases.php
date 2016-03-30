<?php
require 'lib/site.inc.php';
$view = new Felis\CasesView($site);
if(!$view->protect($site, $user)) {
header("location: " . $view->getProtectRedirect());
exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Felis Investigations Cases</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/css/felis.css">
</head>

<body>
<div class="cases">
<nav>
	<ul class="left">
		<li><a href="./">The Felix Agency</a></li>
	</ul>
	<ul class="right">
		<li><a href="staff.php">Staff</a></li>
	</ul>
</nav>

<header class="main">
	<h1><img src="images/comfortable.png" alt="Felis Mascot"> Felis Cases <img src="images/comfortable.png" alt="Felis Mascot"></h1>
</header>

<?php
echo $view->present();
echo $view->footer();
?>



</div>

</body>
</html>
