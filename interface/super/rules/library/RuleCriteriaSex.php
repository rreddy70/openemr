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

    function getCharacteristics() {
    }

    function getRequirements() {
        return out( $this->value, false );
    }

    function getTitle() {
        return out( "Sex", false );
    }

}
?>
