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
        $requirements = xl( "Value" ) . ": ";
        if ( is_null($this->matchValue ) ) {
            $requirements .= xl( "Any" );
        } else {
            $requirements .= "'" . $this->matchValue . "'";
        }
        return $requirements;
    }

    function getTitle() {
        $label = xl_layout_label( $this->getLabel( $this->type) );
        return xl( "Lifestyle" ) . " - " . $label;
    }

    function getView() {
        // xxx todo
        return NULL;
    }

}
?>
