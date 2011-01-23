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
            'minute'        =>  new ReminderIntervalType( 'minute', out( 'Minutes', false ) ),
            'hour'          =>  new ReminderIntervalType( 'hour', out( 'Hours', false ) ),
            'day'           =>  new ReminderIntervalType( 'day', out('Days', false ) ),
            'week'          =>  new ReminderIntervalType( 'week', out('Weeks', false ) ),
            'month'         =>  new ReminderIntervalType( 'month', out('Months', false ) ),
            'year'          =>  new ReminderIntervalType( 'year', out('Years', false ) ),
            'flu_season'    =>  new ReminderIntervalType( 'flu_season', out('Flu season', false ) )
        );
        return $map;
    }
}
?>
