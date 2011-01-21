<?php
require_once("../include/header.php");
require_once("../alerts/controller/controller.php");

$actionRouter = new ActionRouter( new Controller_Browse(), dirname(__FILE__), $GLOBALS['srcdir'] . "/../", $GLOBALS['webroot'] );
$actionRouter->route();
?>
