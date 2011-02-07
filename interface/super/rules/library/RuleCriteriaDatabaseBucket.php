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

    function getDbView() {
        $dbView = new RuleCriteriaDbView(
            "database",
            "",
            "CUSTOM::" 
                . $this->category . "::" . $this->item . "::"
                . ($this->completed ? "YES":"NO") . "::"
                . $this->frequencyComparator . "::" . $this->frequency,
            $this->optional,
            $this->inclusion
        );
        return $dbView;
    }

    function updateFromRequest() {
        parent::updateFromRequest();

        $category = _post("fld_category");
        $categoryLbl = _post("fld_category_lbl");
        $item = _post("fld_item");
        $itemLbl = _post("fld_item_lbl");
        $completed = _post("fld_completed");
        $frequency = _post("fld_frequency");
        $frequencyComparator = _post("fld_frequency_comparator");

        // xxx todo update layout options based on category and item labels

//        $this->category;
//        $this->item;
        $this->completed = $completed == 'yes';
        $this->frequency = $frequency;
        $this->frequencyComparator = $frequencyComparator;
    }

}
?>
