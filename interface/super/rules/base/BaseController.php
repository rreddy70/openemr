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
class BaseController {

    var $viewBean;

    public function _action_error() {
        $this->viewBean->_view = "error.php";
    }

}
?>
