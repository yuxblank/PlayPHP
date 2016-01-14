<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Messages
 *
 * @author yuri.blanc
 */
class Messages {
    private $type;
    private $message;
    
    function __construct($type=null, $message=null) {
        $this->type = $type;
        $this->message = $message;
    }
    public function error($message) {
        
    }

}
