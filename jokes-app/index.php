<?php

ini_set('display_errors', 1);

include __DIR__ . '/vendor/autoload.php';

use App\Database;

(new Database());

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $namespace = "\\App\\Controllers\\";

    $router->get('/', $namespace . 'JokesController@index');
    $router->post('/', $namespace . 'JokesController@index');
    $router->get('/jokes', $namespace . 'JokesController@index');
    $router->post('/jokes', $namespace . 'JokesController@index');

    $router->get('/jokes/create', $namespace . 'JokesController@create');
    $router->post('/jokes/create', $namespace . 'JokesController@create');

    $router->get('/jokes/admin', $namespace . 'JokesController@admin');
    $router->post('/jokes/admin', $namespace . 'JokesController@store');

    $router->get('/jokes/approved/{id:\d+}', $namespace . 'JokesController@approve');
    $router->get('/jokes/approved', $namespace . 'JokesController@approved');

    $router->get('/jokes/deleted/{id:\d+}', $namespace . 'JokesController@delete');
    $router->get('/jokes/deleted', $namespace . 'JokesController@deleted');

    $router->post('/jokes/deleteold', $namespace . 'JokesController@deleteold');
    $router->get('/jokes/deleteold', $namespace . 'JokesController@deleteold');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = explode('@', $handler);
        (new $controller)->$method($vars);
        break;
}

function view(string $path, array $vars = [])
{
    extract($vars);

    include(__DIR__ . '/app/Views/' . $path . '.php');
}

function redirect(string $location)
{
    header('Location: ' . $location);
}



