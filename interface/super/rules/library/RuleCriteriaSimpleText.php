<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaSimpleText
 *
 * @author aron
 */
class RuleCriteriaSimpleText extends RuleCriteria {
    var $title;
    var $value;

    function __construct( $title, $value ) {
        $this->title = $title;
        $this->value = $value;
    }

    function getRequirements() {
        return $this->value;
    }

    function getTitle() {
        return $this->title;
    }

    function getView() {
        return "simple_text_criteria.php";
    }

}
?>
