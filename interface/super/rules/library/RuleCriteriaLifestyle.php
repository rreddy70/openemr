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
        return "lifestyle.php";
    }

    function getOptions() {

        $stmt = sqlStatement(
            "SELECT field_id, title FROM layout_options "
           ."WHERE form_id = 'HIS' AND group_name LIKE '%Lifestyle%'" );

        $options = array();

        for( $iter=0; $row=sqlFetchArray($stmt); $iter++ ) {
            $id = $row['field_id'];
            $label = xl_layout_label( $row['title'] );
            $option = new Option( $id, $label );
            array_push( $options, $option );
        }

        return $options;
    }

}
?>
