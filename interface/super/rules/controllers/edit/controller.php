<?php
class Controller_edit extends BaseController {

    function _action_summary() {
        $ruleId = _get('id');
        $rule = $this->getRuleManager()->getRule( $ruleId );

        $this->viewBean->rule = $rule;
        $this->set_view( "summary.php" );
    }

    function _action_submit_summary() {
        $ruleId = _post('id');
        $types = _post('fld_ruleTypes');
        $title = _post('fld_title');
        $this->getRuleManager()->updateSummary( $ruleId, $types, $title );
        $this->redirect("index.php?action=detail!view&id=$ruleId");
    }

    function _action_intervals() {
        $ruleId = _get('id');
        $rule = $this->getRuleManager()->getRule( $ruleId );

        $this->viewBean->rule = $rule;
        $this->set_view( "intervals.php" );
    }

    function _action_submit_intervals() {
        // parse results from response
        $ruleId = _post('id');
        $rule = $this->getRuleManager()->getRule($ruleId );

        // new intervals object
        $intervals = new ReminderIntervals();
        $change = false;
        foreach( ReminderIntervalType::values() as $type ) {
            foreach( ReminderIntervalRange::values() as $range ) {
                $amtKey = $type->code . "-" . $range->code;
                $timeKey = $amtKey . "-timeunit";

                $amt = _post($amtKey);
                $timeUnit = TimeUnit::from( _post($timeKey) );

                if ( $amt && $timeUnit ) {
                    $detail = new ReminderIntervalDetail($type, $range, $amt, $timeUnit );
                    $intervals->addDetail($detail);
                    $change = true;
                }
            }
        }
        if ( $change ) {
            $this->getRuleManager()->updateIntervals( $rule, $intervals );
        }
        
        $this->redirect("index.php?action=detail!view&id=$ruleId");
    }

    function _action_filter() {
        $ruleId = _get('id');
        $rule = $this->getRuleManager()->getRule( $ruleId );
        $guid = _get('guid');
        $criteria = $this->getRuleManager()->getRuleFilterCriteria( $rule, $guid );

        $this->viewBean->type = "filter";
        $this->viewBean->rule = $rule;
        $this->viewBean->criteria = $criteria;

        $this->addHelper("common.php");

        $this->set_view( $criteria->getView(), "criteria.php" );
    }

    function _action_target() {
        $ruleId = _get('id');
        $rule = $this->getRuleManager()->getRule( $ruleId );
        $guid = _get('guid');
        $criteria = $this->getRuleManager()->getRuleTargetCriteria($rule, $guid);

        $this->viewBean->type = "target";
        $this->viewBean->rule = $rule;
        $this->viewBean->criteria = $criteria;

        $this->addHelper("common.php");

        $this->set_view( $criteria->getView(), "criteria.php" );
    }

    function _action_codes() {
        $search = _get('q');
        $codes = $this->getCodeManager()->search( $search );
        foreach( $codes as $code ) {
            echo $code->display() . "|". $code->id . "\n";
        }
    }

    function _action_columns() {
        $columns = array();
        $table = _get('table');
        $stmts = sqlStatement( "SHOW COLUMNS FROM " . $table );
        for($iter=0; $row=sqlFetchArray($stmts); $iter++) {
            $columns[] = $row['Field'];
        }
        $this->emit_json($columns);
    }

    function _action_submit_criteria() {
        // parse results from response
        $ruleId = _post('id');
        $rule = $this->getRuleManager()->getRule($ruleId );

        $guid = _post('guid');
        $type = _post('type');
        if ( $type == "filter" ) {
            $criteria = $this->getRuleManager()->getRuleFilterCriteria( $rule, $guid );
        } else {
            $criteria = $this->getRuleManager()->getRuleTargetCriteria( $rule, $guid );
        }

        if ( $criteria ) {
            $dbView = $criteria->getDbView();

            // xxx todo remove debugging
            echo "BEFORE:<br/>";
            echo "method: " . $dbView->method . "<br/>";
            echo "methodDetail: " . $dbView->methodDetail . "<br/>";
            echo "value: " . $dbView->value . "<br/>";
            echo "inclusion: " . $dbView->inclusion . "<br/>";
            echo "optional: " . $dbView->optional . "<br/>";

            $criteria->updateFromRequest();
            $dbView = $criteria->getDbView();

            echo "<br/>AFTER:<br/>";
            echo "method: " . $dbView->method . "<br/>";
            echo "methodDetail: " . $dbView->methodDetail . "<br/>";
            echo "value: " . $dbView->value . "<br/>";
            echo "inclusion: " . $dbView->inclusion . "<br/>";
            echo "optional: " . $dbView->optional . "<br/>";

            if ( $type == "filter" ) {
                $this->ruleManager->updateFilterCriteria( $rule, $criteria );
            } else {
                $this->ruleManager->updateTargetCriteria( $rule, $criteria );
            }
        }

        $this->redirect("index.php?action=detail!view&id=$ruleId");

    }

}
?>
