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
        $label = xl_layout_label( $this->getLabel() );
        return out( "Lifestyle", false ) . " - " . $label;
    }

    private function getLabel() {
        $sql = sqlStatement(
            "SELECT title from layout_options WHERE field_id = ?", array($this->type)
        );
        if (sqlNumRows($sql) > 0) {
            $result = sqlFetchArray( $sql );
            return $result['title'];
        } else {
            return $this->title;
        }
    }
}
?>
