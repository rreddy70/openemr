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
     * @return RuleCriteriaType
     */
    function resolveRuleCriteriaType( $method, $methodDetail, $value ) {
        if (strpos($method, "sex") ) {
            return RuleCriteriaType::from(RuleCriteriaType::sex);
        }
        return null;
    }

    /**
     * @param RuleCriteriaType $ruleCriteriaType
     * @return RuleCriteria
     */
    function build( $ruleCriteriaType, $value, $methodDetail ) {
        return new RuleCriteriaSex( $value == 'Male' );
    }

    /**
     *
     * @param RuleCriteriaType $criteriaType
     */
    function newInstance( $criteriaType ) {
        return new RuleCriteriaSex( true );
    }

}
?>
