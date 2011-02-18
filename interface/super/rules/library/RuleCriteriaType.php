<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaType
 *
 * @author aron
 */
class RuleCriteriaType {

    var $code;
    var $lbl;

    function __construct( $code, $lbl ) {
        $this->lbl = $lbl;
        $this->code = $code;
    }

    /**
     *
     * @param string $value
     * @return RuleCriteriaType
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
            'age_min'   =>  new ReminderIntervalType( 'age_min', 'Age min' ),
            'age_max'   =>  new ReminderIntervalType( 'age_max', 'Age max' ),
            'sex'       =>  new ReminderIntervalType( 'sex', 'Sex' ),

            'diagnosis' =>  new ReminderIntervalType( 'diagnosis', 'Diagnosis' ),
            'issue'     =>  new ReminderIntervalType( 'issue', 'Medical issue' ),
            'medication'=>  new ReminderIntervalType( 'medication', 'Medication' ),
            'allergy'   =>  new ReminderIntervalType( 'allergy', 'Allergy' ),
            'surgery'   =>  new ReminderIntervalType( 'surgery', 'Surgery' ),

            'lifestyle'    =>  new ReminderIntervalType( 'lifestyle', 'Lifestyle' ),
            'custom'    =>  new ReminderIntervalType( 'custom', 'Custom' )
        );
        return $map;
    }
    

}
?>
