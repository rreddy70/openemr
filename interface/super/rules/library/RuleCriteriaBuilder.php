<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaBuilder
 *
 * @author aron
 */
abstract class RuleCriteriaBuilder {
    
    /**
     * @return RuleCriteria
     */
    abstract function build( $method, $methodDetail, $value );
}
?>
