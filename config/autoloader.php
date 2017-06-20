<?php

namespace iBDL;

spl_autoload_register(function($class) {
	
    if (strpos($class, 'iBDL\\') === 0) {
		
		$parts = explode("\\", rtrim($class, "\\"));
		
		$className = array_pop($parts);
		
        $name = substr(implode(DS, $parts), strlen('iBDL'));
		
        $file = __DIR__  . DS . ".." 
                . strtolower($name . DS) . $className . '.php';
		

        if (!file_exists($file)) {
            echo "file not find: \n";
			pr($file);
        } else {
            require_once $file;
        }	
    }
	
	// Doctrine
    if (strpos($class, 'Doctrine\\') === 0) {
		
		$parts = explode("\\", rtrim($class, "\\"));
		
		$className = array_pop($parts);
		
        $name = substr(implode(DS, $parts), strlen('Doctrine'));
		
        $file = VENDOR . "doctrine2" . DS . "lib" . DS . "Doctrine"
			. $name . DS . $className . '.php';
		

        if (!file_exists($file)) {
            echo "file not find: \n";
			pr($file);
        } else {
            require_once $file;
        }	
    }
});