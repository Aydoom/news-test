<?php 
use core\App;

$router = new core\Router();

$router
    ->any('/', function() {
        $app = new App();
        $app->run("news", "index");
    })
    ->get('/news', function(){
        $app = new App();
        $app->run("news", "show");
    })
    ->post('/news', function(){
        $app = new App();
        $app->run("news", "update");
    })
    ->put('/news', function(){
        $app = new App();
        $app->run("news", "create");
    })
    ->delete('/news', function(){
        $app = new App();
        $app->run("news", "delete");
    })
    ->any('*', function() {
        $app = new App();
        $app->abort(404);
    });
