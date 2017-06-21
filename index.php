<?php 
//header('Content-Type: text/html; charset=utf8');

require_once "config/bootstrap.php";

// create tables into mysql
//require VENDOR . "php-mysql-migration/index.php";

// run APP
require APP . "router.php";
