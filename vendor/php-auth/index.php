<?php 

use PAuth\Core\Auth as Auth;

require_once "config.php";
require_once "autoload.php";
require_once "functions.php";

PAuth\Core\Session::start();
PAuth\Core\DB::connect($config);