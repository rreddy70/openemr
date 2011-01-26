/*
 * 
 */
var rule_edit = function( args ) {
 
    var fn_work = function() {
        // setup required
        $(".req").each( function() {
            var txt = $(this).text();
            txt = "<span class='required'>*</span>" + txt;
            $(this).html( txt );
        });

        if ($(".req").length > 1) {
            $("#required_msg").show();
        }
    }

    var fn_validate = function() {
        String.prototype.trim = function() {
            return this.replace(/^\s+|\s+$/g,"");
        }

        // clear previous validation markings
        $(".field_err_marker").removeClass("field_err_marker");
        $(".field_err_lbl_marker").removeClass("field_err_lbl_marker");

        var success = true;
        $(".req").each( function() {
            var label = $(this);
            var fldName = label.attr("data-fld");
            var fld = $("[name='" + fldName + "']");
            if ( fld.length > 0 ) {
                if ( fld.length == 1 ) {
                    // likely dealing with some kind of textbox
                    var val = fld.attr("value");
                    if ( !val || val.trim() == "" ) {
                        fld.addClass("field_err_marker");
                        label.addClass("field_err_lbl_marker");
                        success = false;
                    }
                } else {
                    // likely dealing with a set
                    var fieldSet = fld.serializeArray();
                    if (fieldSet.length == 0) {
                        label.addClass("field_err_lbl_marker");
                        success = false;
                    }
                }
            } 
        });
        
        return success;
    }

    var fn_wire_events = function() {
        $('#btn_save').click( function() {
           if ( fn_validate() ) {
               $('#frm_submit').submit();
           }
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