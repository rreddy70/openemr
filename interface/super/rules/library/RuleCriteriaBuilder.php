<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaBuilder
 *
 * @author aron
 */
abstract class RuleCriteriaBuilder {


    /**
     * @return RuleCriteriaType
     */
    abstract function resolveRuleCriteriaType( $method, $methodDetail, $value  );
    
    /**
     * @param RuleCriteriaType $ruleCriteriaType
     * @return RuleCriteria
     */
    abstract function build( $ruleCriteriaType, $value, $methodDetail );

    abstract function newInstance( $criteriaType );

}
?>
