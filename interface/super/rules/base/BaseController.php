<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author aron
 */
abstract class BaseController {

    var $viewBean;
    public function _action_error() {
        $this->viewBean->_view = "error.php";
    }

    /**
     * By default, controllers have no default action
     */
    function _action_default() {
        $this->_action_error();
    }

    public function emit_json( $object ) {
        header('Content-type: application/json');
        echo json_encode( $object );
    }

    public function set_view( $view, $template='' ) {
        $this->viewBean->_view = $view;
        if ( $template ) {
            $this->viewBean->_template = $template;
        }
    }

    public function forward( $forward ) {
        $this->viewBean->_forward = $forward;
    }

    public function redirect( $redirect ) {
        $this->viewBean->_redirect = $redirect;
    }

}
?>
