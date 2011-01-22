<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * todo docs
 * enum
 * @author aron
 */
class TimeUnit {
    var $code;
    var $lbl;

    function __construct( $code, $lbl ) {
        $this->lbl = $lbl;
        $this->code = $code;
    }

    /**
     *
     * @param string $value
     * @return ReminderIntervalType
     */
    public static function from( $code ) {
        $map = self::map();
        return $map[$code];
    }

    public static function values() {
        $map = self::map();
        return array_keys($map);
    }

    private static function map() {
        $map = array(
            'minute'    =>  new ReminderIntervalType( 'minute', 'Minute(s)' ),
            'hour'      =>  new ReminderIntervalType( 'hour', 'Minute(s)' ),
            'day'       =>  new ReminderIntervalType( 'day', 'Day(s)' ),
            'week'      =>  new ReminderIntervalType( 'week', 'Week(s)' ),
            'month'     =>  new ReminderIntervalType( 'month', 'Month(s)' ),
            'year'      =>  new ReminderIntervalType( 'year', 'Year(s)' )
        );
        return $map;
    }
}
?>
