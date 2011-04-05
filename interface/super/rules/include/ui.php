<?php

	require_once( $GLOBALS['fileroot'] . "/library/options.inc.php" );


    function getLabel( $value, $list_id ) {
        // get from list_options
    	$result = generate_display_field(array('data_type'=>'1','list_id'=>$list_id), $value);
    	if ( $result != '') {
    		return $result;
    	}
    	            
        // if not found, default to the passed-in value
        return $value;
    }

    function getLayoutLabel( $value ) {
        // get from layout_options
    	$sql = sqlStatement(
            "SELECT title from layout_options WHERE field_id = ?", array($value)
        );
        if (sqlNumRows($sql) > 0) {
            $result = sqlFetchArray( $sql );
            return $result['title'];
        }
    	
        // if not found, default to the passed-in value
        return $value;
    	    	
    }
    
?>
