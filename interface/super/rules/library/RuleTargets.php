<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleTargets
 *
 * @author aron
 */
class RuleTargets {
    var $ruleId;
    var $criteria = array();

    function __construct() {
    }

    /**
     * @param RuleCriteria $criteria
     */
    function add( $criteria ) {
        array_push( $this->criteria, $criteria );
    }

}
?>
