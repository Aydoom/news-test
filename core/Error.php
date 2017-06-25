<?php
namespace core;

class Error {

    public static function msg($msg) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error [' . $msg . ']', true, 500);
    }
    
    public static function e404() {
        header("HTTP/1.0 404 Not Found");
    }
}
