<?php
require("../../globals.php");
$fake_register_globals=false;
$sanitize_all_escapes=true;

require_once("ui.php");
require_once("common.php");

require_once("base/ActionRouter.php");
require_once("base/ControllerRouter.php");
require_once("base/BaseController.php");

// recursively require all .php files in the library folder
foreach (glob( library_dir() . "/*.php") as $filename) {
    require_once( $filename );
}
?>
