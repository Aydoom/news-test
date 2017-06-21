<?php

namespace core;

/**
 * Description of Request
 *
 * @author Aydoom
 */
class Request {

    static public $vars = [];

    static public function init($array = false) {
        $request = ($array) ? $array : $_REQUEST;
        foreach ($request as $key => $val) {
            if (is_array($val)) {
                $request[$key] = self::init($val);
            } else {
                $request[$key] = htmlspecialchars(strip_tags(trim($val)));
            }
        }
        
        return $request;
    }
    
    static public function get($name) {
        if (empty(self::$vars)) {
            self::$vars = self::init();
        }
        
        eval('$value = self::$vars[' . str_replace(["[]", "."], ["", "]["], $name) . '];');

        return $value;
    }
    
    static public function add($array) {
        if (empty(self::$vars)) {
            self::$vars = self::init();
        }
        //pr(self::$vars);
        self::$vars = array_merge(self::$vars, self::init($array));
    }
    
    static public function has($name) {
        
        return (self::get($name) !== null);
    }
    
    static public function set($name, $value) {
        eval('self::$vars[' . str_replace(".", "][", $name) . '] = ' . $value . ';');
    }
}
