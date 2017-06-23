<?php 

require_once __Dir__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'DB.php';
require_once __Dir__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Cookie.php';
require_once __Dir__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Session.php';
require_once __Dir__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Auth.php';


spl_autoload_register(function ($class) 
{
    $path = explode("\\", ltrim($class, "\\"));

    $root = array_shift($path);
    $fileName = array_pop($path) . ".php";

    if ($root === "PAuth") {
        $path = array_map('strtolower', $path);
        $fileUrl = __Dir__ . DIRECTORY_SEPARATOR
                . implode(DIRECTORY_SEPARATOR, $path)
                . DIRECTORY_SEPARATOR . $fileName;

        if (file_exists($fileUrl)) {
            include_once $fileUrl;
        } else {
            echo "Class: <b>{$class}</b><br>Not exists: $fileUrl";
        }
    }
});