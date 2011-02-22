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

    const Week = "week";
    const Month = "month";
    const Year = "year";

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
        return array_values($map);
    }

    private static function map() {
        $map = array(
            'minute'        =>  new TimeUnit( 'minute', xl( 'Minutes' ) ),
            'hour'          =>  new TimeUnit( 'hour', xl( 'Hours' ) ),
            'day'           =>  new TimeUnit( 'day', xl('Days' ) ),
            'week'          =>  new TimeUnit( 'week', xl('Weeks' ) ),
            'month'         =>  new TimeUnit( 'month', xl('Months' ) ),
            'year'          =>  new TimeUnit( 'year', xl('Years' ) ),
            'flu_season'    =>  new TimeUnit( 'flu_season', xl('Flu season' ) )
        );
        return $map;
    }
}
?>
