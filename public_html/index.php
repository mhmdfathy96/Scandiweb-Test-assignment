<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\ProductController;
use app\controllers\Router;

$router =new Router();
$router->get('/',[ProductController::class,'index']);
$router->get('/products',[ProductController::class,'index']);
$router->get('/products/create',[ProductController::class,'create']);
$router->post('/products/create',[ProductController::class,'create']);
$router->post('/products/delete',[ProductController::class,'delete']);

$router->addNotFound(function(){
    require_once __DIR__.'/../view/products/404.php';
});

$router->resolve();