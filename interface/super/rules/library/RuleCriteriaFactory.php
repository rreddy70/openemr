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
class RuleCriteriaFactory {

    var $strategyMap;

    function __construct() {
        $this->strategyMap['filt_age_min'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['filt_age_max'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['filt_sex'] = new RuleCriteriaSexBuilder();
        $this->strategyMap['filt_lists'] = '';
        $this->strategyMap['filt_database'] = '';
    }

    /**
     *
     * @param RuleCriteria $criteria
     */
    function build($ruleId, $inclusion, $optional,
            $method, $methodDetail, $value) {

        $builder = $this->strategyMap[ $method ];
        if ( is_null( $builder ) ) {
            // if no builder, then its an unrecognized critiera
            return null;
        }

        $criteria = $builder->build( $method, $methodDetail, $value );
        $criteria->inclusion = $inclusion;
        $criteria->optional = $optional;

        return $criteria;
    }

}
?>
