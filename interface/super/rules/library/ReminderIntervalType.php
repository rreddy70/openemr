<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * enum
 * @author aron
 */
class ReminderIntervalType {

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
            'clinical'  =>  new ReminderIntervalType( 'clinical', xl( 'Clinical' ) ),
            'patient'   =>  new ReminderIntervalType( 'patient', xl( 'Patient' ) )
        );
        return $map;
    }

}
?>
