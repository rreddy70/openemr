<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaSex
 *
 * @author aron
 */
class RuleCriteriaSex extends RuleCriteria {
    
    var $male;

    function __construct( $male ) {
        $this->male = $male;
    }

    function getRequirements() {
        return $this->male ? xl( 'Male' ) : xl( 'Female' );
    }

    function getTitle() {
        return xl( "Sex" );
    }

    function getView() {
        return "sex.php";
    }

    function getOptions() {
        $options = array();
        $options[] = array( "id" => "male", "label" => "Male" );
        $options[] = array( "id" => "female", "label" => "Female" );
        return $options;
    }

    function getDbView() {
        $dbView = new RuleCriteriaDbView(
            "sex",
            "",
            $this->male ? "Male" : "Female",
            $this->optional,
            $this->inclusion
        );
        return $dbView;
    }

    function updateFromRequest() {
        parent::updateFromRequest();

        $sex = _post("fld_sex");
        $this->male = $sex == 'male';
    }

}
?>
