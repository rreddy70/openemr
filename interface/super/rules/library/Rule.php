<?php
/**
 * This is the primary domain object representing a rule in the rules engine.
 * Rules are composed of:
 * - one or more rule types (see RuleType enum)
 * - a ReminderIntervals object
 * - a RuleFilters object
 * - a RuleTargets object
 * - a RuleActions object
 *
 * Rules are typically assembled by the RuleManager.
 * @author aron
 */
class Rule {
    var $ruleTypes;
    var $id;
    var $title;

    /**
     * @var ReminderIntervals
     */
    var $reminderIntervals;

    /**
     * @var RuleFilters
     */
    var $filters;

    /**
     * @var RuleTargets
     */
    var $targets;

    /**
     * @var RuleActions
     */
    var $actions;

    function __construct( $id, $title='', $ruleTypes=array() ) {
        $this->id = $id;
        $this->title = $title;
        $this->ruleTypes = $ruleTypes;
    }

    function getTitle() {
        return $this->title;
    }

    function addRuleType( $ruleType ) {
        if ( !$this->hasRuleType($ruleType) ) {
            array_push($this->ruleTypes, $ruleType );
        }
    }

    function hasRuleType( $ruleType ) {
        return in_array( $ruleType, $this->ruleTypes );
    }

    function isActiveAlert() {
        return $this->hasRuleType( RuleType::ActiveAlert );
    }

    function isPassiveAlert() {
        return $this->hasRuleType( RuleType::PassiveAlert );
    }

    function isCqm() {
        return $this->hasRuleType( RuleType::CQM );
    }

    function isAmc() {
        return $this->hasRuleType( RuleType::AMC );
    }

    function isReminder() {
        return $this->hasRuleType( RuleType::PatientReminder );
    }

    /**
     * @param ReminderIntervals $reminderIntervals
     */
    function setReminderIntervals( $reminderIntervals ) {
        $this->reminderIntervals = $reminderIntervals;
    }

    /**
     *
     * @param RuleFilters $ruleFilters 
     */
    function setRuleFilters( $ruleFilters ) {
        $this->filters = $ruleFilters;
    }

    /**
     *
     * @param RuleTargets $ruleTargets
     */
    function setRuleTargets( $ruleTargets ) {
        $this->targets = $ruleTargets;
    }

    /**
     * @param RuleActions $actions
     */
    function setRuleActions( $actions ) {
        $this->actions = $actions;
    }
}
?>
