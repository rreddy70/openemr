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
    function __construct( $title, $value ) {
        parent::__construct($title, $value);
    }

    function getDbView() {
        $dbView = new RuleCriteriaDbView(
            "lists",
            "medical_problem",
            "CUSTOM::" . $this->value,
            $this->optional,
            $this->inclusion
        );
        return $dbView;
    }

}
?>
