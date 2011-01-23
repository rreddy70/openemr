<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReminderIntervalDetail
 *
 * @author aron
 */
class ReminderIntervalDetail {
    /**
     *
     * @var ReminderIntervalType
     */
    var $intervalType;
    /**
     *
     * @var ReminderIntervalRange
     */
    var $intervalRange;
    var $amount;
    /**
     *
     * @var TimeUnit
     */
    var $timeUnit;

    /**
     *
     * @param ReminderIntervalType $type
     * @param ReminderIntervalRange $range
     * @param integer $amount
     * @param TimeUnit $unit
     */
    function __construct( $type, $range, $amount, $unit ) {
        $this->intervalType = $type;
        $this->intervalRange = $range;
        $this->amount = $amount;
        $this->timeUnit = $unit;
    }

    function display() {
        $display = $this->intervalRange->lbl . ": "
                 . $this->amount . " " . $this->timeUnit->lbl;
        return $display;
    }
    
}
?>
