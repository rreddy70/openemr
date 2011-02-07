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
    var $interval;

    /**
     * @var TimeUnit
     */
    var $intervalType;

    /**
     * uniquely identifies this criteria
     * @var string
     */
    var $guid;

    function getCharacteristics() {
        $characteristics = $this->optional ? xl ( "Optional" ) : xl ( "Required" );
        $characteristics .= " ";
        $characteristics .= $this->inclusion ? xl( "Inclusion" ) : xl( "Exclusion" );

        return $characteristics;
    }

    abstract function getRequirements();
    
    abstract function getTitle();

    abstract function getView();

    function getInterval() {
        if ( is_null($this->interval) || is_null( $this->intervalType ) ) {
            return null;
        }
        return $this->interval . " x " . " "
             . $this->intervalType->lbl;
    }

    protected function getLabel( $value ) {
        return getLabel($value);
    }

    protected function decodeComparator( $comparator ) {
        switch ( $comparator ) {
            case "eq": return "";
                break;
            case "ne": return "!=";
                break;
            case "gt": return ">";
                break;
            case "lt": return "<";
                break;
            case "ge": return ">=";
                break;
            case "le": return "<=";
                break;
        }
        return "";
    }

    /**
     * @return RuleCriteriaDbView
     */
    abstract function getDbView();

    function updateFromRequest() {
        $inclusion = "yes" ==  _post("fld_inclusion");
        $optional = "yes" == _post("fld_optional");

        $this->optional = $optional;
        $this->inclusion = $inclusion;
    }

}
?>
