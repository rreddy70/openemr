<?php
require("../../globals.php");
$fake_register_globals=false;
$sanitize_all_escapes=true;

require_once("ui.php");
require_once("common.php");

// recursively require all .php files in the base library folder
foreach (glob( base_dir() . "base/library/*.php") as $filename) {
    require_once( $filename );
}

// recursively require all .php files in the application library folder
foreach (glob( library_dir() . "/*.php") as $filename) {
    require_once( $filename );
}

?>
