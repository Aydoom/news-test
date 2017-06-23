<?php 
use PMMigration\Tables as Table;

require_once "config.php";
require_once "autoload.php";
require_once "functions.php";


// Connect with DataBase
$DB = new PMMigration\Core\DB($config);

// Create tables
require_once 'scenarios/simple.php';
scenarioRun($DB);
