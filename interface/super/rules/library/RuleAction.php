<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleAction
 *
 * @author aron
 */
class RuleAction {
    var $category;
    var $item;

    function __construct() {
    }

    function getTitle() {
        return getLabel( $this->category ) . " - " . getLabel( $this->item );
    }
}
?>
