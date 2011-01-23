<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaLifestyle
 *
 * @author aron
 */
class RuleCriteriaLifestyle extends RuleCriteria {
    var $type;
    var $matchValue;

    function __construct( $type, $matchValue ) {
        $this->type = $type;
        $this->matchValue = $matchValue;
    }

    function getRequirements() {
        $requirements = out( "Value", false ) . ": ";
        if ( is_null($this->matchValue ) ) {
            $requirements .= out( "Any", false );
        } else {
            $requirements .= "'" . $this->matchValue . "'";
        }
        return $requirements;
    }

    function getTitle() {
        $label = xl_layout_label( $this->getLabel( $this->type) );
        return out( "Lifestyle", false ) . " - " . $label;
    }
}
?>
