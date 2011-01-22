<?php

function out( $txt, $print=true) {
    $val = htmlspecialchars( xl( $txt ), ENT_NOQUOTES);
    if ($print) {
        echo $val;
    } else {
        return $val;
    }

}

/**
 * * xxx todo: sanitize inputs
 * @param <type> $var
 * @param <type> $default
 * @return <type> 
 */
function _get( $var, $default='' ) {
    $val = $_GET[$var];
    return isset($val) && $val != '' ? $val : $default;
}

/**
 * xxx todo: sanitize inputs
 * @param <type> $var
 * @param <type> $default
 * @return <type>
 */
function _post( $var, $default='' ) {
    $val = $_POST[$var];
    return isset($val) && $val != '' ? $val : $default;
}

function _base_url() {
    return $GLOBALS['webroot'] . '/interface/super/rules';
}

function src_dir() {
    return $GLOBALS['srcdir'];
}

function base_dir() {
    return dirname(__FILE__) . "/../";
}

function library_dir() {
    return base_dir() . '/library';
}

function library_src( $file ) {
    return library_dir() . "/$file";
}

function js_src( $file ) {
    echo _base_url() . '/www/js/' . $file;
}

function css_src( $file ) {
    echo _base_url() . '/www/css/' . $file;
}

function controller_basedir() {
    return realpath( base_dir() . '/controllers/' );
}
function controller_dir( $controller ) {
    $dir = controller_basedir() . '/'. $controller;
    if ( realpath( $dir . '/../') != controller_basedir() )  {
        throw Exception("Invalid controller '$controller'");
    }
    return $dir;
}

?>
