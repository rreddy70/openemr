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
class RuleCriteriaMedication extends RuleCriteriaSimpleText {
    function __construct( $title, $value ) {
        parent::__construct($title, $value);
    }

    function getDbView() {
        $dbView = new RuleCriteriaDbView(
            "lists",
            "medication",
            $this->value,
            $this->optional,
            $this->inclusion
        );
        return $dbView;
    }

}
?>
