<?php
require_once( src_dir() . "/clinical_rules.php");

class Controller_browse extends BaseController {

    function _action_list() {
        $this->set_view( "list.php" );
    }

    function _action_getrows() {
        $rows = array();

        $rules = resolve_rules_sql();
        foreach( $rules as $rowRule ) {
            $titleResult = sqlFetchArray( sqlStatement(
                    "SELECT title FROM list_options WHERE option_id = ?", array( $rowRule['id'] ) ) );
            $title = $titleResult['title'];
            $type = $rowRule['patient_reminder_flag'] == 1 ? "Reminder" : "CQM/AMC";

            $row = array(
                "title" => $title,
                "type"  => $type,
                "id"    => $rowRule['id']
            );
            $rows[] = $row;
        }

        $this->emit_json( $rows );
    }

}
?>
