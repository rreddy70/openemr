/*
 * 
 */
var rule_edit = function( args ) {
 
    var fn_work = function( sort ) {
        // todo
    }

    var fn_wire_events = function() {
        // todo
        $('#btn_save').click( function() {
           $('#frm_submit').submit();
        });
    }

    return {
            init: function() {
                $( document ).ready( function() {
                    fn_wire_events();
                    fn_work();
                });
            }
    };

}