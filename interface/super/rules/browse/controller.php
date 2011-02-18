<?php
class Controller_Browse extends BaseController {

    function _action_list() {
        $this->viewBean->name = "Aron";
        $this->viewBean->age = 35;

        ///
        $this->viewBean->_view = "list.php";
    }

    function _action_submit() {

        $this->viewBean->name = _post("name");
        $this->viewBean->age = _post("age");

        ///
        $this->viewBean->_view = "view.php";
    }

    function _action_undecorated() {
        $this->viewBean->_view = "view.php";
        $this->viewBean->_template = "undecorated.php";
    }

    function _action_forward() {
        $this->viewBean->name = "(this comes from the server!) " . " " . _post("name") ;
        $this->viewBean->age = 213 + _post("age");

        ///
        $this->viewBean->_forward = "undecorated";
    }

    function _action_yahoo() {
        $this->viewBean->_redirect = "http://www.yahoo.com";
    }

    function _action_json() {
        $myObject->name = "Aron";
        $myObject->age = "32";
        $mySuperObject->myObject = $myObject;
        $this->emit_json( $mySuperObject );
    }

}
?>
