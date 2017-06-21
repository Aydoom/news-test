<?php 
use core\App as App;

$router = new core\Router();

$router
    ->any('/', function() {
        $app = new App();
        $app->run("news", "index");
    })
    ->get('/:controller/:action', function($controller, $action){
        $app = new App();
        $app->run($controller, $action);
    })
    ->any('*', function() {
        $app = new App();
        $app->abort(404);
    });
