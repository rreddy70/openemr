<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaFactory
 *
 * @author aron
 */
abstract class RuleCriteriaFactory {

    /**
     *
     * @param RuleCriteria $criteria
     */
    function build($ruleId, $inclusion, $optional,
            $method, $methodDetail, $value) {

        $strategyMap = $this->getStrategyMap();
        $builder = $strategyMap[ $method ];
        if ( is_null( $builder ) ) {
            // if no builder, then its an unrecognized critiera
            return null;
        }

        $criteria = $builder->build( $method, $methodDetail, $value );
        if ( is_null( $criteria ) ) {
            return null;
        }
        $criteria->inclusion = $inclusion;
        $criteria->optional = $optional;

        return $criteria;
    }

    abstract function getStrategyMap();
}
?>
