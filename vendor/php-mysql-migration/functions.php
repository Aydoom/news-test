<?php

if (!function_exists('pr')) {
    function pr($array = "Test Run", $end = true)
    {
        /*echo "<pre>";
            print_r(debug_backtrace());
        echo "</pre>";*/
        echo "<pre>";
            print_r($array);
        echo "</pre>";
        
        echo "<br/><br/><br/><br/>";
        echo "<p> ------------ DEBUG -------------- </p>";
        
        $debug = debug_backtrace();
        
        echo "<pre>";
            print_r(['file' => $debug[0]['file'], 'line' => $debug[0]['line']]);
        echo "</pre>";
        
        if ($end) {
            exit();
        }
    }
}