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
        $dbView = parent::getDbView();

        $dbView->method = "sex";
        $dbView->methodDetail = "";
        $dbView->value = $this->male ? "Male" : "Female";
        return $dbView;
    }

    function updateFromRequest() {
        parent::updateFromRequest();

        $sex = _post("fld_sex");
        $this->male = $sex == 'male';
    }

}
?>
