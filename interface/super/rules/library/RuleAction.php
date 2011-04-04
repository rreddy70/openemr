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
    var $guid;
    var $id;
    var $category;
    var $categoryLbl;
    var $item;
    var $itemLbl;
    var $reminderLink;
    var $reminderMessage;
    var $customRulesInput;
    var $groupId;
    var $targetCriteria;

    function __construct() {
    }

    function getTitle() {
        return getLabel( $this->category, 'rule_action_category' ) . " - " . getLabel( $this->item, 'rule_action' );
    }

    function getCategoryLabel() {
        if ( !$this->categoryLbl ) {
            $this->categoryLbl = getLabel( $this->category, 'rule_action_category');
        }
        return $this->categoryLbl;
    }

    function getItemLabel() {
        if ( !$this->itemLbl ) {
            $this->itemLbl = getLabel( $this->item, 'rule_action');
        }
        return $this->itemLbl;
    }
}
?>
