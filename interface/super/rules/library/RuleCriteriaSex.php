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

}
?>
