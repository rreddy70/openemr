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
    var $value;
    var $optional;
    var $inclusion;


    function __construct( $method, $methodDetail, $value, $optional, $inclusion ) {
        $this->method = $method;
        $this->methodDetail = $methodDetail;
        $this->value = $value;
        $this->optional = $optional;
        $this->inclusion = $inclusion;
    }
}
?>
