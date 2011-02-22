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
    function build($ruleId, $guid, $inclusion, $optional,
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
        $criteria->guid = $guid;

        $this->modify($criteria, $ruleId);

        return $criteria;
    }

    abstract function getStrategyMap();

    abstract function modify($criteria, $ruleId);

}
?>
