<?php

    function getLabel( $value ) {
        // first try layout_options
        $sql = sqlStatement(
            "SELECT title from layout_options WHERE field_id = ?", array($value)
        );
        if (sqlNumRows($sql) > 0) {
            $result = sqlFetchArray( $sql );
            return $result['title'];
        }

        // second try list_options
        $sql = sqlStatement(
            "SELECT title from list_options WHERE option_id = ?", array($value)
        );
        if (sqlNumRows($sql) > 0) {
            $result = sqlFetchArray( $sql );
            return $result['title'];
        }

        // if in neither place, default to the passed-in value
        return $value;
    }


?>
