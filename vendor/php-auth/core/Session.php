<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PAuth\Core;

/**
 * Description of Session
 *
 * @author Aydoom
 */
class Session {
    
    static public $fields = [];
    
    static public function start() {
        session_start();
        
        self::$fields = $_SESSION;
    }
    
    static public function set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    static public function get($name) {
        return $_SESSION[$name];
    }
}
