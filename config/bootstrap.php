<?php
session_start();

define ("DS", DIRECTORY_SEPARATOR);

define("ROOT", realpath(__DIR__ . DS . "..") . DS);
    define("CONFIG", ROOT . "config" . DS);
    define("VIEW", ROOT . "view" . DS);
    
require_once CONFIG . "autoloader.php";
require_once CONFIG . "basic.php";

// Include DB
function config() {
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
        return array(
            'host' 	=> 'localhost',
            'dbname' 	=> 'ibdl',
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
