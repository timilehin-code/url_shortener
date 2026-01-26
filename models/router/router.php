<?php

declare(strict_types=1);

namespace App\Router;

class Router
{
  private array  $routes = [];


  public function add(string $path, callable $handler)
  {
    $this->routes[$path] = $handler;
  }

  public function dispatch(string $path)
  {
    foreach ($this->routes as $route => $handler) {
      $regex = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([^/]+)', $route);
      $regex = '#^' . $regex . '$#';
      if (preg_match($regex, $path, $matches)) {
        array_shift($matches);


        call_user_func_array($handler, $matches);
        return;
      }
    }
    http_response_code(404);
    require ".../../404.php";
  }
}
