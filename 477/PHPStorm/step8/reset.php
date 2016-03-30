<?php
$open = true;
require 'lib/site.inc.php';
$view = new Felis\ResetView($site, $_GET);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="login">

    <!--    Implace the Header-->
    <?php
    echo $view->header();
    echo $view->present();
    echo $view->footer();
    ?>

</div>

</body>
</html>
