<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaDatabaseCustom
 *
 * @author aron
 */
class RuleCriteriaDatabaseCustom extends RuleCriteria {

    var $table;
    var $column;
    var $valueComparator;
    var $value;
    var $frequencyComparator;
    var $frequency;

    function __construct( $table, $column, 
                    $valueComparator, $value,
                    $frequencyComparator, $frequency) {
        $this->table = $table;
        $this->column = $column;
        $this->valueComparator = $valueComparator;
        $this->value = $value;
        $this->frequencyComparator = $frequencyComparator;
        $this->frequency = $frequency;
    }

    function getRequirements() {
        $requirements = "";
        if ( $this->value ) {
            $requirements .= xl( "Value" ) . ": ";
            $requirements .= $this->decodeComparator($this->valueComparator) . " " . $this->value;
            $requirements .= " | ";
        }
        
        $requirements .= xl( "Frequency" ) . ": ";
        $requirements .= $this->decodeComparator($this->frequencyComparator) . " " . $this->frequency;

        return $requirements;
    }

    function getTitle() {
        return $this->table . "." . $this->column;
    }

    function getView() {
        return "custom.php";
    }

    
}
?>
