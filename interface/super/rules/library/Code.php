<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Code
 *
 * @author aron
 */
class Code {
    //put your code here

    var $id;
    var $code;
    var $text;
    var $codeType;

    function __construct( $id, $code, $text, $codeType ) {
        $this->id = $id;
        $this->code = $code;
        $this->text = $text;
        $this->codeType = $codeType;
    }

    function display() {
        return $this->codeType . ":" . $this->id . " - " . $this->code . " " . $this->text;
    }
    
}

?>
