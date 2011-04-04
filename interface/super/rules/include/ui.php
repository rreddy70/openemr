<?php

	require_once( $GLOBALS['fileroot'] . "/library/options.inc.php" );


    function getLabel( $value, $list_id='' ) {
        // first try layout_options
        // NOTE: Currently there are no library functions in library/options.inc.php to extract
        //		 labels from layout_options table. So, keep the code for direct SQL query here.
        $sql = sqlStatement(
            "SELECT title from layout_options WHERE field_id = ?", array($value)
        );
        if (sqlNumRows($sql) > 0) {
            $result = sqlFetchArray( $sql );
            return $result['title'];
        }

        // second try list_options
    	$result = generate_display_field(array('data_type'=>'1','list_id'=>$list_id), $value);
    	if ( $result != '') {
    		return $result;
    	}
    	
       
        
//        $sql = sqlStatement(
//            "SELECT title from list_options WHERE option_id = ?", array($value)
//        );
//        if (sqlNumRows($sql) > 0) {
//            $result = sqlFetchArray( $sql );
//            return $result['title'];
//        }

        // if in neither place, default to the passed-in value
        return $value;
    }
    


?>
