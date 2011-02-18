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

    function getDbView() {
        $dbView = parent::getDbView();

        $dbView->method = "lists";
        $dbView->methodDetail = "medical_problem";
        $dbView->value = $this->codeType . "::" . $this->id;
        return $dbView;
    }

    function updateFromRequest() {
        parent::updateFromRequest();
        $value = _post("fld_value");
        $exploded = explode(" ", $value);
        $diagInfo = explode(":", $exploded[0]);
        $this->codeType = $diagInfo[0];
        $this->id = $diagInfo[1];
    }

}
?>
