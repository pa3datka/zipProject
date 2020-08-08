<?php

use Application\Core\Router;

spl_autoload_register(function ($class){
    $ds = DIRECTORY_SEPARATOR;
   $path = $_SERVER['DOCUMENT_ROOT'].$ds.str_replace('\\', $ds, $class). '.php';
   if (file_exists($path)) {
       include $path;
   }
});

$router = new Router();

$router->run();