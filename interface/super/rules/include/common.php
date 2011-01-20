<?php

function out( $txt ) {
    echo htmlspecialchars( xl( $txt ), ENT_NOQUOTES);
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

function _base_dir() {
    return dirname(__FILE__) . "/../";
}

?>
