<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaDatabaseBucketBuilder
 *
 * @author aron
 */
class RuleCriteriaDatabaseBucket extends RuleCriteria {
    var $category;
    var $item;
    var $completed;
    var $frequencyComparator;
    var $frequency;

    function __construct( $category, $item, $completed,
                    $frequencyComparator, $frequency ) {
        $this->category = $category;
        $this->item = $item;
        $this->completed = $completed;
        $this->frequencyComparator = $frequencyComparator;
        $this->frequency = $frequency;
    }

    function getRequirements() {
        $requirements .= xl( "Completed" ) . ": ";
        $requirements .= $this->completed ? xl( "Yes" ) : xl( "No" );
        $requirements .= " | ";
        $requirements .= xl( "Frequency" ) . ": ";
        $requirements .= $this->decodeComparator( $this->frequencyComparator ) . " "
                       . $this->frequency . " ";
        return $requirements;
    }

    function getTitle() {
        return $this->getCategoryLabel() . " - " . $this->getItemLabel();
    }

    function getCategoryLabel() {
        return $this->getLabel($this->category);
    }

    function getItemLabel() {
        return $this->getLabel($this->item);
    }

    function getView() {
        return "bucket.php";
    }

}
?>
