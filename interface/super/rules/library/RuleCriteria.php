<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteria
 *
 * @author aron
 */
abstract class RuleCriteria {
    /**
     * if true, then criteria is optional; required otherwise
     * @var boolean
     */
    var $optional;

    /**
     * if true, then criteira is an inclusion; exclusion otherwise
     * @var boolean
     */
    var $inclusion;

    /**
     * @var string
     */
    var $value;

    abstract function getCharacteristics();
    abstract function getRequirements();
    abstract function getTitle();

}
?>
