<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleActions
 *
 * @author aron
 */
class RuleActions {
    var $actions = array();

    function __construct() {
    }

    /**
     * @param RuleAction $action
     */
    function add( $action ) {
        array_push( $this->actions, $action );
    }
}
?>
