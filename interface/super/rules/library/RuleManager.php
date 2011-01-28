<?php

require_once( src_dir() . "/clinical_rules.php");
require_once( library_src( 'RuleCriteriaFilterFactory.php') );
require_once( library_src( 'RuleCriteriaTargetFactory.php') );

/**
 * Responsible for handling the persistence (CRU operations, deletes are
 * not currently supported).
 * This class should be kept synchronized with clinical_rules.php
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
    "SELECT * FROM rule_filter WHERE id = ?";

    const SQL_RULE_TARGET =
    "SELECT * FROM rule_target WHERE id = ?";

    const SQL_RULE_INTERVAL =
    "SELECT * FROM rule_target 
     WHERE method = 'target_interval'
       AND id = ?";

    const SQL_RULE_ACTIONS =
    "SELECT * FROM rule_action
     WHERE id = ?";

    const SQL_UPDATE_FLAGS =
    "UPDATE clinical_rules
        SET active_alert_flag = ?,
            passive_alert_flag = ?,
            cqm_flag = ?,
            amc_flag = ?,
            patient_reminder_flag = ?
      WHERE id = ?";

    const SQL_UPDATE_TITLE =
    "UPDATE list_options
        SET title = ?
      WHERE option_id = ?";

    const SQL_REMOVE_INTERVALS =
    "DELETE FROM rule_reminder
           WHERE id = ?";

    const SQL_INSERT_INTERVALS =
    "INSERT INTO rule_reminder
            (id, method, method_detail, value)
     VALUES ( ?, ?, ?, ?)";

    var $filterCriteriaFactory;
    var $targetCriteriaFactory;

    function __construct() {
        $this->filterCriteriaFactory = new RuleCriteriaFilterFactory();
        $this->targetCriteriaFactory = new RuleCriteriaTargetFactory();
    }

    /**
     * Returns a Rule object if the supplied rule id matches a record in
     * clinical_rules. An optional patient id parameter allows you to get the
     * rules specific to the patient.
     *
     * Returns null if no rule is found matching the id or patient.
     * @param <type> $id
     * @param <type> $pid
     * @return Rule
     */
    function getRule($id, $pid = 0) {
        $ruleResult = sqlQuery( 
            self::SQL_RULE_DETAIL . " WHERE id = ? AND pid = ?", array($id, $pid)
        );

        if ( !$ruleResult ) {
            return null;
        }

        $rule = new Rule($id, $ruleResult['title']);
        $this->fillRuleTypes( $rule, $ruleResult );
        $this->fillRuleReminderIntervals( $rule );
        $this->fillRuleFilterCriteria( $rule );
        $this->fillRuleTargetCriteria( $rule );
        $this->fillRuleActions( $rule );

        return $rule;
    }

    /**
     * Adds a RuleType to the given rule based on the sql result row
     * passed to it, evaluating the *_flag columns.
     * @param Rule $rule
     */
    private function fillRuleTypes( $rule, $ruleResult ) {
        if ($ruleResult['active_alert_flag'] == 1) {
            $rule->addRuleType(RuleType::from(RuleType::ActiveAlert));
        }
        if ($ruleResult['passive_alert_flag'] == 1) {
            $rule->addRuleType(RuleType::from(RuleType::PassiveAlert));
        }
        if ($ruleResult['cqm_flag'] == 1) {
            $rule->addRuleType(RuleType::from(RuleType::CQM));
        }
        if ($ruleResult['amc_flag'] == 1) {
            $rule->addRuleType(RuleType::from(RuleType::AMC));
        }
        if ($ruleResult['patient_reminder_flag'] == 1) {
            $rule->addRuleType(RuleType::from(RuleType::PatientReminder));
        }
    }

    /**
     * Fills the given rule with criteria derived from the rule_filter
     * table. Relies on the RuleCriteriaFilterFactory for the parsing of
     * rows in this table into concrete subtypes of RuleCriteria.
     * @param Rule $rule
     */
    private function fillRuleFilterCriteria( $rule ) {
        $criterion = $this->gatherCriteria($rule, self::SQL_RULE_FILTER,
                $this->filterCriteriaFactory);
        if ( sizeof( $criterion ) > 0 ) {
            $ruleFilters = new RuleFilters();
            $rule->setRuleFilters($ruleFilters);
            foreach( $criterion as $criteria ) {
                $ruleFilters->add( $criteria );
            }
        }
    }

    /**
     * Fills the given rule with criteria derived from the rule_target
     * table. Relies on the RuleCriteriaTargetFactory for the parsing of
     * rows in this table into concrete subtypes of RuleCriteria.
     * @param Rule $rule
     */
    private function fillRuleTargetCriteria( $rule ) {
        $criterion = $this->gatherCriteria($rule, self::SQL_RULE_TARGET,
                $this->targetCriteriaFactory);
        if ( sizeof( $criterion ) > 0 ) {
            $ruleTargets = new RuleTargets();
            $rule->setRuleTargets($ruleTargets);
            foreach( $criterion as $criteria ) {
                $ruleTargets->add( $criteria );
            }    
        }

    }

    /**
     * Given a sql source for gathering rule criteria (target or filter), this
     * method relies on its supplied subtype of RuleCriteriaFactory to parse out
     * instances of RuleCriteria from the sql source (typically rule_filter or
     * rule_target).
     *
     * Returns an array of RuleCriteria subtypes, if they were parsable from the
     * supplied sql source.
     * @param Rule $rule
     * @param string $criteraSrcSql
     * @param RuleCriteriaFactory $factory
     */
    private function gatherCriteria( $rule, $criteraSrcSql, $factory ) {
        $stmt = sqlStatement( $criteraSrcSql, array( $rule->id ) );
        $criterion = array();

        for($iter=0; $row=sqlFetchArray($stmt); $iter++) {
            $method = $row['method'];
            $methodDetail = $row['method_detail'];
            $value = $row['value'];
            $inclusion = $row['include_flag'] == 1;
            $optional = $row['required_flag'] == 1;

            $criteria = $factory->build( $rule->id, $inclusion, $optional,
                    $method, $methodDetail, $value );


            if ( is_null($criteria) ) {
                // unrecognized critera
                continue;
            }

            // get interval
            $intervalSql = sqlStatement( self::SQL_RULE_INTERVAL, array($rule->id) );
            if (sqlNumRows($intervalSql) > 0) {
                $result = sqlFetchArray( $intervalSql );
                $criteria->interval = $result['interval'];
                $criteria->intervalType = TimeUnit::from( $result['value'] );
            }

            // else
            $criterion[] = $criteria;
        }
        return $criterion;
    }

    /**
     * Creates a ReminderIntervals object from rows in the rule_reminder table,
     * and sets it in the supplied Rule.
     * @param Rule $rule
     */
    private function fillRuleReminderIntervals( $rule ) {
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

    /**
     * Creates a RuleActions object from rows in the rule_action table, and sets
     * it on the supplied Rule.
     * @param Rule $rule
     */
    private function fillRuleActions( $rule ) {
        $stmt = sqlStatement( self::SQL_RULE_ACTIONS, array( $rule->id ) );
        $actions = new RuleActions();

        $hasActions = false;

        for($iter=0; $row=sqlFetchArray($stmt); $iter++) {
            $action = new RuleAction();
            $action->category = $row['category'];
            $action->item = $row['item'];
            $actions->add($action);
            $hasActions = true;
        }

        if ( $hasActions ) {
            $rule->setRuleActions( $actions );
        }

    }

    function updateSummary( $ruleId, $types, $title ) {
        $rule = $this->getRule( $ruleId );

        // update flags
        sqlQuery(sqlStatement( self::SQL_UPDATE_FLAGS, array(
            in_array(RuleType::ActiveAlert, $types) ? 1 : 0,
            in_array(RuleType::PassiveAlert, $types) ? 1 : 0,
            in_array(RuleType::CQM, $types) ? 1 : 0,
            in_array(RuleType::AMC, $types) ? 1 : 0,
            in_array(RuleType::PatientReminder, $types) ? 1 : 0,
            $rule->id )
        ));

        // update title
        sqlQuery( sqlStatement( self::SQL_UPDATE_TITLE, array( $title,
            $ruleId ) ));
    }

    /**
     *
     * @param Rule $rule
     * @param ReminderIntervals $intervals
     */
    function updateIntervals( $rule, $intervals ) {
        // remove old intervals
        sqlQuery(sqlStatement( self::SQL_REMOVE_INTERVALS, array( $rule->id )));

        // insert new intervals
        foreach( $intervals->getTypes() as $type ) {
            $typeDetails = $intervals->getDetailFor($type);
            foreach( $typeDetails as $detail ) {
                sqlQuery( sqlStatement( self::SQL_INSERT_INTERVALS, array(
                    $rule->id,                                                      //id
                    $type->code . "_reminder_" . $detail->intervalRange->code,      // method
                    $detail->timeUnit->code,                                        // method_detail
                    $detail->amount                                                 // value
                )));

            }
        }
    }

}
?>
