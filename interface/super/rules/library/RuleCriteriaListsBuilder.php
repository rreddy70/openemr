<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaListsBuilder
 *
 * @author aron
 */
class RuleCriteriaListsBuilder extends RuleCriteriaBuilder {

    function build( $method, $methodDetail, $value ) {

        if ( $methodDetail == 'medical_problem' ) {
            $exploded = explode("::", $value);
            if ( $exploded[0] == "CUSTOM" ) {
                // its a medical issue
                return new RuleCriteriaSimpleText( xl( "Medical Issue" ), $exploded[1] );
            } else {
                // assume its a diagnosis
                return new RuleCriteriaSimpleText( xl( "Diagnosis" ), $exploded[0] . " " . $exploded[1] );
            }
        } else if ( $methodDetail == 'medication' ) {
            // its a medication
            return new RuleCriteriaSimpleText( xl( "Medication" ), $value );
        }

        // its unknown
        return null;
    }
}
?>
