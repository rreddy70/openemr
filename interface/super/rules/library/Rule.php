<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rule
 *
 * @author aron
 */
class Rule {
    var $ruleTypes;
    var $id;
    var $title;

    /**
     *
     * @var ReminderIntervals
     */
    var $reminderIntervals;

    /**
     * @var RuleFilters
     */
    var $filters;

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
}
?>
