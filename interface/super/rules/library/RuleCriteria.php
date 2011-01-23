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

    /**
     * @var string
     */
    var $interval;

    /**
     * @var TimeUnit
     */
    var $intervalType;

    function getCharacteristics() {
        $characteristics = $this->optional ? out ( "Optional", false ) : out ( "Required", false );
        $characteristics .= " ";
        $characteristics .= $this->inclusion ? out( "Inclusion", false ) : out( "Exclusion", false );

        return $characteristics;
    }

    abstract function getRequirements();
    
    abstract function getTitle();

    function getInterval() {
        if ( is_null($this->interval) || is_null( $this->intervalType ) ) {
            return null;
        }
        return $this->interval . " x " . " "
             . $this->intervalType->lbl;
    }

    protected function getLabel( $value ) {
        // first try layout_options
        $sql = sqlStatement(
            "SELECT title from layout_options WHERE field_id = ?", array($value)
        );
        if (sqlNumRows($sql) > 0) {
            $result = sqlFetchArray( $sql );
            return $result['title'];
        }

        // second try list_options
        $sql = sqlStatement(
            "SELECT title from list_options WHERE option_id = ?", array($value)
        );
        if (sqlNumRows($sql) > 0) {
            $result = sqlFetchArray( $sql );
            return $result['title'];
        }

        // if in neither place, default to the passed-in value
        return $value;
    }

    protected function decodeComparator( $comparator ) {
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
