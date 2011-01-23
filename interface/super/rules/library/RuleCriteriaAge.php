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
        $title = xl( "Age" );
        if ( $this->type == 'min' ) {
            $tile .= " " . xl( "min" );
        } else {
            $tile .= " " . xl( "max" );
        }

        $title .= " (" . $this->timeUnit->lbl . ")";
        return $title;
    }

}
?>
