<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaDbModel
 *
 * @author aron
 */
class RuleCriteriaDbView {

    var $method;
    var $methodDetail;
    var $optional;
    var $inclusion;

    var $interval;
    var $intervalType;

    function __construct() {
    }

    function set( $i ) {
        $this->intervalType = $i;
    }

    function get() {
        return $this->intervalType;
    }
}
?>
