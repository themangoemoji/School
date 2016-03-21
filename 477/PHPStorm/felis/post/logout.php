<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/20/16
 * Time: 11:18 PM
 */

require '../lib/site.inc.php';

$root = $site->getRoot();
header("location: " . $root . '/');