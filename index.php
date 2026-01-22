<?php
require 'vendor/autoload.php';

use App\Router\Router;

$router = new Router();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path =  trim($path, '/'); 
$path = ltrim(str_replace('url_shortener', '', $path), '/');


$router->add("", function(){
   require 'public/views/index.php';
});
$router->add("home", function(){
   require 'public/views/index.php';
});

$router->dispatch($path);