<?php 
namespace PAuth\Core;

use iBDL\Core\Router as Router;

class Auth {
    
    static public $user;
    
    /**
     *
     */
    static public function falseLogin() {
        Session::set('falseUri', Router::$request);
  
        return false;
    }
    
    /**
     *
     */
    static public function getFalseUrl() {
        return Session::get('falseUri');
    }
    
    /**
     * 
     * @return boolean
     */
    static public function isLogin() {

        logs(__METHOD__);
        //pr($_COOKIE, false);
        $userID = Cookie::getUserID();
        $token = Cookie::getUserToken();
        
        logs('userID=>' . $userID . ":" . 'token=>' . $token);
        //pr([$userID, $token], false);
        if (!empty($userID) && !empty($token)) {
            //pr('has cookies', false);
            self::$user = DB::getUserByToken($userID, $token);
            //pr(self::$user, false);
        } else {
            logs('return false by empty Cookie');
            return self::falseLogin();
        }
        //pr(self::$user);
        
        if (empty(self::$user)) {
            logs('return false by empty User');
            return self::falseLogin();
        } else {
            logs('return true');
            //pr('return true', false);
            Cookie::updateTime();
            return true;
        }
    }

    /**
     *
     */
    static public function login($userName, $password) {
        self::$user = DB::getUserByPsw($userName, $password);
        
        if (empty(self::$user['id'])) {
            return false;
        }
               
        logs(__METHOD__ . "[" . self::$user['id'] . "]");
        Cookie::setUserId(self::$user['id']);
        Cookie::setUserToken(md5(md5(rand(10000, 100000))));
        
        return DB::saveUserToken(self::$user['id']);
    }
    
    /**
     * 
     * @param type $userName
     * @param type $passw
     * @param type $r_passw
     * @param type $userGroup
     * @return boolean
     */
    static public function registration($userName, $passw, $r_passw, $userGroup = 1) {
        if ($passw === $r_passw) {
            DB::createUser($userName, $passw, $userGroup);
        } else {
            return false;
        }
    }
}