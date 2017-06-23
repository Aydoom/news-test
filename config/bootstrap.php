<?php
define("DS", DIRECTORY_SEPARATOR);

define("ROOT", realpath(__DIR__ . DS . "..") . DS);
    define("CONFIG", ROOT . "config" . DS);
    define("APP", ROOT . "app" . DS);
        define("CONTROLLER", APP . "controller" . DS);
        define("MODEL", APP . "model" . DS);
        define("VIEW", APP . "view" . DS);
            define("ELEMENT", VIEW . "element" . DS);
    define("CORE", ROOT . "core" . DS);
    define("VENDOR", ROOT . "vendor" . DS);
    
require_once CONFIG . "autoloader.php";
require_once CONFIG . "basic.php";

// Include DB
function config() {
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
        return array(
            'host' 	=> 'localhost',
            'dbname' 	=> 'news',
            'user'	=> 'root',
            'password'	=> '',
            'port'	=> 3306,
            'driver'	=> 'mysql'
        );
    } else {
        return array(
            'host' 	=> 'localhost',
            'dbname' 	=> 'TEST',
            'user'	=> 'root',
            'password'	=> '',
            'port'	=> 3306,
            'driver'	=> 'mysql'
        );
    }
}
