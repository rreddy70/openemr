<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaAge
 *
 * @author aron
 */
class RuleCriteriaAge extends RuleCriteria {
    var $type;
    var $value;
    var $timeUnit;

    /**
     *
     * @param TimeUnit $timeUnit
     */
    function __construct( $type, $value, $timeUnit ) {
        $this->type = $type;
        $this->value = $value;
        $this->timeUnit = $timeUnit;
    }

    function getRequirements() {
        return $this->value;
    }

    function getTitle() {
        $title = out( "Age", false );
        if ( $this->type == 'min' ) {
            $tile .= " " . out( "min", false );
        } else {
            $tile .= " " . out( "max", false );
        }

        $title .= " (" . $this->timeUnit->lbl . ")";
        return $title;
    }

}
?>
