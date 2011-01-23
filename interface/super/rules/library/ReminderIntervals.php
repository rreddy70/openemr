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
class ReminderIntervals {

    var $detailMap;

    function __construct() {
        $this->detailMap = array();
    }

    /**
     *
     * @param ReminderIntervalDetail $detail
     */
    function addDetail( $detail ) {
        $details = $this->detailMap[ $detail->intervalType->code ];
        if ( is_null( $details ) ) {
            $details = array();
        }
        array_push( $details, $detail );
        $this->detailMap[ $detail->intervalType->code ] = $details;
    }

    function getTypes() {
        $types = array();
        foreach ( array_keys( $this->detailMap ) as $code )  {
            array_push( $types, ReminderIntervalType::from( $code ) );
        }
        return $types;
    }

    /**
     *
     * @param ReminderIntervalType $type
     * @return array
     */
    function getDetailFor( $type ) {
        return $this->detailMap[ $type->code ];
    }

    function displayDetails( $type ) {
        $details = $this->getDetailFor($type);
        $display = "";
        foreach( $details as $detail ) {
            if ( $display != "" ) {
                $display .= ", ";
            }
            $display .= $detail->display();
        }
        return $display;
    }

}
?>
