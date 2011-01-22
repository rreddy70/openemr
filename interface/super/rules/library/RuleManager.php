<?php

require_once( src_dir() . "/clinical_rules.php");

/**
 * Description of RuleManager
 *
 * @author aron
 */
class RuleManager {
    const SQL_RULE_DETAIL =
    "SELECT lo.title as title, cr.*
           FROM clinical_rules cr
           JOIN list_options lo ON cr.id = lo.option_id";

    const SQL_RULE_REMINDER_INTERVAL =
    "SELECT id,
            method,
            method_detail,
            value
       FROM rule_reminder
      WHERE id = ?";

    const SQL_RULE_FILTER =
    "SELECT * FROM rule_filter where id = ?";

    var $ruleCriteriaFactory;

    function __construct() {
        $this->ruleCriteriaFactory = new RuleCriteriaFactory();
    }

    /**
     *
     * @param <type> $id
     * @param <type> $pid
     * @return Rule
     */
    function getRule($id, $pid = 0) {
        // xxx todo move this logic into a DAO
        $ruleResult = sqlFetchArray( sqlStatement(
                self::SQL_RULE_DETAIL . " WHERE id = ? AND pid = ?",
                array($id, $pid))
        );

        $rule = new Rule($id, $ruleResult['title']);
        // populate rule types
        if ($ruleResult['active_alert_flag'] == 1) {
            $rule->addRuleType(RuleType::ActiveAlert);
        }
        if ($ruleResult['passive_alert_flag'] == 1) {
            $rule->addRuleType(RuleType::PassiveAlert);
        }
        if ($ruleResult['cqm_flag'] == 1) {
            $rule->addRuleType(RuleType::CQM);
        }
        if ($ruleResult['amc_flag'] == 1) {
            $rule->addRuleType(RuleType::AMC);
        }
        if ($ruleResult['patient_reminder_flag'] == 1) {
            $rule->addRuleType(RuleType::PatientReminder);
        }

        //
        $this->fillRuleReminderIntervals( $rule );

        //
        $this->fillRuleFilterCriteria( $rule );

        return $rule;
    }

    /**
     *
     * @param Rule $rule
     */
    function fillRuleFilterCriteria( $rule ) {
        $stmt = sqlStatement( self::SQL_RULE_FILTER, array( $rule->id ) );
        $ruleFilters = new RuleFilters();
        $rule->setRuleFilters($ruleFilters);

        for($iter=0; $row=sqlFetchArray($stmt); $iter++) {
            $method = $row['method'];
            $methodDetail = $row['method_detail'];
            $value = $row['value'];
            $inclusion = $row['include_flag'] == 1;
            $optional = $row['required_flag'] == 1;

            $criteria = $this->ruleCriteriaFactory->build( $ruleId, $inclusion, $optional,
                    $method, $methodDetail, $value );

            
            if ( is_null($criteria) ) {
                // unrecognized critera
                continue;
            }

            // else
            $ruleFilters->add( $criteria );
        }
    }

    /**
     *
     * @param Rule $rule
     */
    function fillRuleReminderIntervals( $rule ) {
        $stmt = sqlStatement( self::SQL_RULE_REMINDER_INTERVAL, array( $rule->id ) );
        $reminderInterval = new ReminderIntervals();

        $hasReminders = false;
        for($iter=0; $row=sqlFetchArray($stmt); $iter++) {
            $amount = $row['value'];
            $unit = TimeUnit::from($row['method_detail']);
            $methodParts = explode( '_', $row['method'] );
            $type = ReminderIntervalType::from( $methodParts[0] );
            $range = ReminderIntervalRange::from( $methodParts[2] );
            if ( !is_null($type) && !is_null($range) && !is_null($unit) ) {
                $detail = new ReminderIntervalDetail( $type, $range, $amount, $unit );
                $reminderInterval->addDetail($detail);
            }
            $hasReminders = true;
        }

        if ( $hasReminders ) {
            $rule->setReminderIntervals( $reminderInterval );
        }
    }

}
?>
