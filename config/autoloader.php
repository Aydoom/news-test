<?php

spl_autoload_register(function($class) {
    $parts = explode("\\", rtrim($class, "\\"));
    
    $className = array_pop($parts);
    $name = implode(DS, $parts);
    $file = __DIR__  . DS . "..". DS . strtolower($name . DS) . $className . '.php';
		
    if (!file_exists($file)) {
        if ($parts[0] !== 'PMMigration') {
            core\Error::msg("file not find: \n" . $file);
        }
    } else {
        require_once $file;
    }	
});