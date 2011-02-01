<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaDiagnosis
 *
 * @author aron
 */
class RuleCriteriaDiagnosis extends RuleCriteria {

    var $title;
    var $codeType;
    var $id;

    function __construct( $title, $codeType, $id ) {
        $this->title = $title;
        $this->codeType = $codeType;
        $this->id = $id;
    }

    function getRequirements() {
        $codeManager = new CodeManager();
        $code = $codeManager->get($this->id);
        if ( is_null( $code ) ) {
            return $this->codeType . ":" . $this->id;
        }
        return $code->display();
    }

    function getTitle() {
        return $this->title;
    }

    function getView() {
        return "diagnosis.php";
    }


}
?>
