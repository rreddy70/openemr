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
        $requirements .= out( "Completed", false ) . ": ";
        $requirements .= $this->completed ? out( "Yes", false ) : out( "No", false );
        $requirements .= " | ";
        $requirements .= out( "Frequency", false ) . ": ";
        $requirements .= $this->decodeComparator( $this->frequencyComparator ) . " "
                       . $this->frequency . " ";
        return $requirements;
    }

    function getTitle() {
        return $this->getLabel($this->category) . " - " . $this->getLabel($this->item);
    }

}
?>
