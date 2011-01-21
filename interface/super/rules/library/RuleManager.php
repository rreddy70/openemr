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

    /**
     *
     * @param <type> $id
     * @param <type> $pid
     * @return Rule
     */
    function getRule($id, $pid = 0) {

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

        return $rule;
    }

}
?>
