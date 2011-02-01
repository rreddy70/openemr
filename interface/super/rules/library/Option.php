<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Option
 *
 * @author aron
 */
class Option {

    var $id;
    var $label;
    
    function __construct( $id, $label ) {
        $this->id = $id;
        $this->label = $label;
    }
}
?>
