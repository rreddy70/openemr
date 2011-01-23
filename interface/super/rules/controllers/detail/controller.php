<?php
class Controller_detail extends BaseController {

    function _action_view() {
        $ruleId = _get('id');
        $rule = $this->getRuleManager()->getRule( $ruleId );
        if ( is_null( $rule ) ) {
            $this->set_view( "error.php" );
        } else {
            $this->viewBean->rule = $rule;
            $this->set_view( "view.php" );
        }
    }

}
?>
