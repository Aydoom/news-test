<?php

spl_autoload_register(function($class) {
    $parts = explode("\\", rtrim($class, "\\"));
    
    $className = array_pop($parts);
    $name = implode(DS, $parts);
    $file = __DIR__  . DS . "..". DS . strtolower($name . DS) . $className . '.php';
		
    if (!file_exists($file)) {
        if ($parts[0] !== 'PMMigration') {
            echo "file not find: \n";
            pr($file, false);
        }
    } else {
        require_once $file;
    }	
});