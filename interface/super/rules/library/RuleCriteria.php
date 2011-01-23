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

    function getCharacteristics() {
        $characteristics = $this->optional ? "Optional" : "Required";
        $characteristics .= " ";
        $characteristics .= $this->inclusion ? "Inclusion" : "Exclusion";

        return out( $characteristics, false );
    }

    abstract function getRequirements();
    abstract function getTitle();

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

}
?>
