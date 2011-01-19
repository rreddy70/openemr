<?php
require_once( library_src( 'RuleCriteriaSimpleText.php') );

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaMedication
 *
 * @author aron
 */
class RuleCriteriaSurgery extends RuleCriteriaSimpleText {
    function __construct( $title, $value = '') {
        parent::__construct($title, $value);
    }

    function getDbView() {
        $dbView = parent::getDbView();

        $dbView->method = "lists";
        $dbView->methodDetail = "surgery";
        $dbView->value = $this->value;
        return $dbView;
    }

}
?>
