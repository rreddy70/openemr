<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaDatabaseBuilder
 *
 * @author aron
 */
class RuleCriteriaDatabaseBuilder extends RuleCriteriaBuilder {

    function __construct() {
    }

    function build( $method, $methodDetail, $value ) {
        $exploded = explode("::", $value);
        if ( $exploded[0] == "LIFESTYLE" ) {
            $type = $exploded[1];
            return new RuleCriteriaLifestyle( $type, sizeof( $exploded ) > 2 ? $exploded[2] : null );
        } else if ( $exploded[0] == 'CUSTOM' ) {
            //
        } else {
            //
        }

        return null;

    }
    
}
?>
