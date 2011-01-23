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
        $requirements .= out( "Completed", false );
        $requirements .= ": " . out( $this->completed ? "Yes" : "No", false );
        $requirements .= " | ";
        $requirements .= out( "Frequency", false );
        $requirements .= ": " . $this->decode( $this->frequencyComparator ) . " "
                              . $this->frequency . " " . out( "times", false );
        return $requirements;
    }

    function getTitle() {
        return $this->getLabel($this->category) . " - " . $this->getLabel($this->item);
    }

    protected function decode( $comparator ) {
        switch ( $comparator ) {
            case "eq": return "exactly";
                break;
            case "ne": return "not";
                break;
            case "gt": return "more than";
                break;
            case "lt": return "less than";
                break;
            case "ge": return "more than or exactly";
                break;
            case "le": return "less than or exactly";
                break;
        }
        return "";
    }

}
?>
