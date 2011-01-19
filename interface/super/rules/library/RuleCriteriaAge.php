<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleCriteriaAge
 *
 * @author aron
 */
class RuleCriteriaAge extends RuleCriteria {
    var $type;
    var $value;
    var $timeUnit;

    /**
     *
     * @param TimeUnit $timeUnit
     */
    function __construct( $type, $value = null, $timeUnit = null) {
        $this->type = $type;
        $this->value = $value;
        $this->timeUnit = $timeUnit;
    }

    function getRequirements() {
        return $this->value;
    }

    function getTitle() {
        $title = xl( "Age" );
        if ( $this->type == "min" ) {
            $title .= " " . xl( "Min" );
        } else {
            $title .= " " . xl( "Max" );
        }

        $title .= " (" . $this->timeUnit->lbl . ")";
        return $title;
    }

    function getType() {
        if ( $this->type == "min" ) {
            return xl( "Min" );
        } else {
            return xl( "Max" );
        }
    }

    function getView() {
        return "age.php";
    }

    function getDbView() {
        $dbView = parent::getDbView();

        $dbView->method = "age_" . $this->type;
        $dbView->methodDetail = $this->timeUnit->code;
        $dbView->value = $this->value;
        return $dbView;
    }

    function updateFromRequest() {
        parent::updateFromRequest();
        $age = _post("fld_value");
        $timeUnit = TimeUnit::from( _post("fld_timeunit") );

        $this->value = $age;
        $this->timeUnit = $timeUnit;
    }
}
?>
