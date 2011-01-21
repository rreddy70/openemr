<?php
class Controller_detail extends BaseController {

    function _action_view() {
        $ruleId = _get('id');
        $rule = $this->getRuleManager()->getRule( $ruleId );
        $this->viewBean->rule = $rule;
        $this->set_view( "view.php" );
    }

}
?>
