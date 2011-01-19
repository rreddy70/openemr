<?php

require_once( library_src( 'RuleCriteriaSimpleText.php') );

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaMedicalIssue
 *
 * @author aron
 */
class RuleCriteriaMedicalIssue extends RuleCriteriaSimpleText {
    function __construct( $title, $value='' ) {
        parent::__construct($title, $value);
    }

    function getDbView() {
        $dbView = parent::getDbView();

        $dbView->method = "lists";
        $dbView->methodDetail = "medical_problem";
        $dbView->value = "CUSTOM::" . $this->value;
        return $dbView;
    }

}
?>
