<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 2/17/16
 * Time: 1:46 PM
 */
require __DIR__ . '/lib/model.inc.php';

$view = new Steampunked\FormView($model);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Steampunked</title>
    <link rel="shortcut icon" type="image/png" href="assets/valve-closed.png"/>
</head>
<body>
<?php echo $view->present(); ?>
</body>
</html>
