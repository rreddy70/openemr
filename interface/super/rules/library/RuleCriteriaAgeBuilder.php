<?php
require_once( library_src( 'RuleCriteriaBuilder.php') );
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaAgeBuilder
 *
 * @author aron
 */
class RuleCriteriaAgeBuilder extends RuleCriteriaBuilder {

    /**
     * @return RuleCriteria
     */
    function build( $method, $methodDetail, $value ) {
        echo $method . "<br>";
        echo $methodDetail . "<br>";
        echo $value . "<br>";
        $criteria = new RuleCriteriaAge( 
                $method == 'filt_age_max' ? 'max' : 'min', 
                $value, 
                TimeUnit::from($methodDetail) 
        );
        
        $criteria->value = $value;
        return $criteria;
    }

}
?>
