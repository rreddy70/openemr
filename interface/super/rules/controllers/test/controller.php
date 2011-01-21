<?php
class Controller_test extends BaseController {

    function _action_start() {
        $this->viewBean->name = "Aron";
        $this->viewBean->age = 35;

        $this->set_view( "test.php" );
    }

    function _action_submit() {
        $this->viewBean->name = _post("name");
        $this->viewBean->age = _post("age");

        $this->set_view( "view.php" );
    }

    function _action_undecorated() {
        $this->set_view( "view.php", "undecorated.php" );
    }

    function _action_forward() {
        $this->viewBean->name = "(this comes from the server!) " . " " . _post("name") ;
        $this->viewBean->age = 213 + _post("age");

        $this->forward("undecorated");
    }

    function _action_yahoo() {
        $this->redirect("http://www.yahoo.com");
    }

    function _action_json() {
        $myObject->name = "Aron";
        $myObject->age = "32";
        $mySuperObject->myObject = $myObject;
        $this->emit_json( $mySuperObject );
    }

}
?>
