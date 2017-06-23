<?php 
use core\App;

$router = new core\Router();

$router
    ->any('/', function() {
        $app = new App();
        $app->run("news", "index");
    })
    ->get('/news/show', function(){
        $app = new App();
        $app->run("news", "show");
    })
    ->post('/news/update', function(){
        $app = new App();
        $app->run("news", "update");
    })
    ->put('/news/create', function(){
        $app = new App();
        $app->run("news", "create");
    })
    ->delete('/news/delete', function(){
        $app = new App();
        $app->run("news", "delete");
    })
    ->any('*', function() {
        $app = new App();
        $app->abort(404);
    });
