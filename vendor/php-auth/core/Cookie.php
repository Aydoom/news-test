<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PAuth\Core;

/**
 * Description of Cookie
 *
 * @author Aydoom
 */
class Cookie {
    
    static private $storage = [];
    

    static function getUserID() {
        if(empty(self::$storage['userId'])) {
            self::$storage['userId'] = filter_input(INPUT_COOKIE, 
                                        'userId', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        
        return self::$storage['userId'];
    }

    static function getUserToken() {
        if(empty(self::$storage['token'])) {
            self::$storage['token'] = filter_input(INPUT_COOKIE, 
                                        'token', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return self::$storage['token'];
    }
    
    static function setUserID($id) {
        if (!setcookie("userId", $id, time() + 3600 * 140, '/')) {
            logs(__METHOD__ . " [cookie Id not save]");
        }
        
        logs(__METHOD__ . " [id=$id]");
        self::$storage['userId'] = $id;
    }

    static function setUserToken($token) {
        if (!setcookie("token", $token, time() + 3600 * 140, '/')) {
            logs(__METHOD__ . " [cookie token not save]");
        }
        
        logs(__METHOD__ . " [token=$token]");
        self::$storage['token'] = $token;
    }
    
    static function updateTime() {
        $userId = filter_input(INPUT_COOKIE, 'userId', FILTER_SANITIZE_SPECIAL_CHARS);
        $token = filter_input(INPUT_COOKIE, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
        
        setcookie("userId", $userId, time() + 3600 * 140, '/');
        setcookie("token", $token, time() + 3600 * 140, '/');
    }
}
