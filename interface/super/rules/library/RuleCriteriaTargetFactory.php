<?php
require_once( library_src( 'RuleCriteriaFactory.php') );

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

    /**
     *
     * @param RuleCriteria $criteria
     */
    function modify($criteria, $ruleId) {
        // get interval
        $result = sqlQuery( self::SQL_RULE_INTERVAL, array($ruleId) );
        $criteria->interval = $result['interval'] ? $result['interval'] : 1;
        $criteria->intervalType = $result['value'] ? TimeUnit::from( $result['value'] ) : TimeUnit::from( TimeUnit::Month );
    }

    /**
     *
     * @param string $ruleId
     * @param RuleCriteriaType $criteriaType
     */
    function buildNewInstance($ruleId, $criteriaType) {
        $criteria = parent::buildNewInstance($ruleId, $criteriaType);
        $criteria->interval = 1;
        $criteria->intervalType = TimeUnit::from( TimeUnit::Month );
        return $criteria;
    }

}
?>
