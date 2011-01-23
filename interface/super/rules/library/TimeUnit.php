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
            'minute'        =>  new ReminderIntervalType( 'minute', xl( 'Minutes' ) ),
            'hour'          =>  new ReminderIntervalType( 'hour', xl( 'Hours' ) ),
            'day'           =>  new ReminderIntervalType( 'day', xl('Days' ) ),
            'week'          =>  new ReminderIntervalType( 'week', xl('Weeks' ) ),
            'month'         =>  new ReminderIntervalType( 'month', xl('Months' ) ),
            'year'          =>  new ReminderIntervalType( 'year', xl('Years' ) ),
            'flu_season'    =>  new ReminderIntervalType( 'flu_season', xl('Flu season' ) )
        );
        return $map;
    }
}
?>
