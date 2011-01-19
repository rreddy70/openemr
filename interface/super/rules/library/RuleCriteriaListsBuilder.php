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

    /**
     * @return RuleCriteriaType
     */
    function resolveRuleCriteriaType( $method, $methodDetail, $value ) {
        if (strpos($method, "lists") ) {
            if ( $methodDetail == 'medical_problem' ) {
                $exploded = explode("::", $value);
                if ( $exploded[0] == "CUSTOM" ) {
                    // its a medical issue
                    return RuleCriteriaType::from( RuleCriteriaType::issue );
                } else {
                    // assume its a diagnosis
                    return RuleCriteriaType::from( RuleCriteriaType::diagnosis );
                }
            } else if ( $methodDetail == 'medication' ) {
                // its a medication
                return RuleCriteriaType::from( RuleCriteriaType::medication );
            }
        }

        return null;
    }


    /**
     * @param RuleCriteriaType $ruleCriteriaType
     * @return RuleCriteria
     */
    function build( $ruleCriteriaType, $value, $methodDetail ) {
        $exploded = explode("::", $value);

        if ( $ruleCriteriaType->code == 'issue' ) {
            return new RuleCriteriaMedicalIssue( xl( "Medical Issue" ), $exploded[1] );
        }

        if ( $ruleCriteriaType->code == 'diagnosis' ) {
            return new RuleCriteriaDiagnosis( xl( "Diagnosis" ), $exploded[0], $exploded[1] );
        }

        if ( $ruleCriteriaType->code == 'medication' ) {
            return new RuleCriteriaMedication( xl( "Medication" ), $value );
        }

        // its unknown
        return null;
    }

    /**
     *
     * @param RuleCriteriaType $criteriaType
     */
    function newInstance( $ruleCriteriaType ) {
        if ( $ruleCriteriaType->code == 'issue' ) {
            return new RuleCriteriaMedicalIssue( xl( "Medical Issue" ) );
        }

        if ( $ruleCriteriaType->code == 'diagnosis' ) {
            return new RuleCriteriaDiagnosis( xl( "Diagnosis" )  );
        }

        if ( $ruleCriteriaType->code == 'medication' ) {
            return new RuleCriteriaMedication( xl( "Medication" ) );
        }

        if ( $ruleCriteriaType->code == 'surgery' ) {
            return new RuleCriteriaSurgery( xl( "Surgery" ) );
        }

        if ( $ruleCriteriaType->code == 'allergy' ) {
            return new RuleCriteriaAllergy( xl( "Allergy" ) );
        }

        return null;
    }

}
?>
