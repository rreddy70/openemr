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
class ReminderIntervalRange {
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
            'pre'  =>  new ReminderIntervalType( 'pre', xl( 'Warning' ) ),
            'post' =>  new ReminderIntervalType( 'post', xl( 'Past due') )
        );
        return $map;
    }

}
?>
