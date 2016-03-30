<?php
require 'lib/site.inc.php';
$view = new Felis\ClientCaseView($site, $_GET);
if(!$view->protect($site, $user)) {
	header("location: " . $view->getProtectRedirect());
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Felis Investigations Case</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/css/felis.css">
</head>

<body>
<div class="case">




	<?php
	echo $view->header();
	echo $view->present();
	echo $view->footer();
	?>



</div>

</body>
</html>
