<?php
require_once( library_src( 'RuleCriteriaFactory.php') );

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaTargetFactory
 *
 * @author aron
 */
class RuleCriteriaTargetFactory extends RuleCriteriaFactory {
    const SQL_RULE_INTERVAL =
    "SELECT * FROM rule_target
     WHERE method = 'target_interval'
       AND id = ?";

    var $strategyMap;

    function __construct() {
        $this->strategyMap['target_age_min'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['target_age_max'] = new RuleCriteriaAgeBuilder();
        $this->strategyMap['target_sex'] = new RuleCriteriaSexBuilder();
        $this->strategyMap['target_lists'] = new RuleCriteriaListsBuilder();
        $this->strategyMap['target_database'] = new RuleCriteriaDatabaseBuilder();
    }

    function getStrategyMap() {
        return $this->strategyMap;
    }

    /**
     *
     * @param RuleCriteria $criteria
     */
    function modify($criteria, $ruleId) {
        // get interval
        $result = sqlQuery( self::SQL_RULE_INTERVAL, array($ruleId) );
        $criteria->interval = $result['interval'];
        $criteria->intervalType = TimeUnit::from( $result['value'] );
    }

}
?>
