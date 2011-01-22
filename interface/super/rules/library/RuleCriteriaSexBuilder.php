<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaSexBuilder
 *
 * @author aron
 */
class RuleCriteriaSexBuilder extends RuleCriteriaBuilder {

    /**
     * @return RuleCriteria
     */
    function build( $method, $methodDetail, $value ) {
        $criteria = new RuleCriteriaSex();
        $criteria->value = $value;
        return $criteria;
    }
}
?>
