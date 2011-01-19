<?php
require_once( library_src( 'RuleCriteriaBuilder.php') );
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaAgeBuilder
 *
 * @author aron
 */
class RuleCriteriaAgeBuilder extends RuleCriteriaBuilder {

    /**
     * @return RuleCriteriaType
     */
    function resolveRuleCriteriaType( $method, $methodDetail, $value ) {
        if (strpos($method, "age_max") ) {
            return RuleCriteriaType::from(RuleCriteriaType::ageMax);
        }
        if (strpos($method, "age_min") ) {
            return RuleCriteriaType::from(RuleCriteriaType::ageMin);
        }
        return null;
    }

    /**
     * @param RuleCriteriaType $ruleCriteriaType
     * @return RuleCriteria
     */
    function build( $ruleCriteriaType, $value, $methodDetail ) {
        $method = $ruleCriteriaType->method;
        $criteria = new RuleCriteriaAge( 
                $method == 'age_max' ? 'max' : 'min', 
                $value, 
                TimeUnit::from($methodDetail) 
        );
        
        $criteria->value = $value;
        return $criteria;
    }

    /**
     *
     * @param RuleCriteriaType $criteriaType
     */
    function newInstance( $criteriaType ) {
        if ( $criteriaType->code == RuleCriteriaType::ageMin ) {
            return new RuleCriteriaAge( 'min' );
        }

        if ( $criteriaType->code == RuleCriteriaType::ageMax ) {
            return new RuleCriteriaAge( 'max' );
        }

        return null;
    }

}
?>
