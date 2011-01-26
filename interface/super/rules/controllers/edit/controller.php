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

}
?>
