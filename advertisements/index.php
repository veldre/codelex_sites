<?php

include __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', config('app.debug'));

session_start();

use Core\Database;
use Core\Managers\FlashMessageManager\FlashMessage;
use Core\Managers\SessionLifetimeManager\SessionManager;

(new Database(
    config('database.host'),
    config('database.username'),
    config('database.password'),
    config('database.database')
));

$sessionManager = SessionManager::get();

if ($sessionManager->hasExpired()) {
    $sessionManager->invalidate();
}

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $namespace = "\\App\\Controllers\\";

    $router->get('/', $namespace . 'HomeController@home');

    $router->get('/auth/signup', $namespace . 'Auth\LoginController@showSignupForm');
    $router->post('/auth/signup', $namespace . 'SignupController@signup');
    $router->get('/auth/login', $namespace . 'Auth\LoginController@showLoginForm');
    $router->post('/auth/login', $namespace . 'Auth\LoginController@login');
    $router->post('/auth/logout', $namespace . 'Auth\LogoutController@logout');


    $router->get('/advertisements', $namespace . 'AdvertisementsController@viewAds');
    $router->post('/advertisements', $namespace . 'AdvertisementsController@viewAds');

    $router->PUT('/advertisements/{id:\d+}', $namespace . 'AdvertisementsController@edit');
    $router->get('/advertisements/create', $namespace . 'AdvertisementsController@create');
    $router->PUT('/advertisements', $namespace . 'AdvertisementsController@store');

    $router->get('/admin', $namespace . 'AdvertisementsController@pendingAds');
    $router->post('/admin/{id:\d+}', $namespace . 'AdminController@deletePending');
    $router->post('/{id:\d+}', $namespace . 'AdminController@deleteExisting');
    $router->post('/approve/{id:\d+}', $namespace . 'AdminController@approve');


    $router->get('/advertisements/submitted', $namespace . 'AdvertisementsController@submitted');
    $router->post('/advertisements/showAd/{id:\d+}', $namespace . 'AdvertisementsController@showAd');



});

(new FlashMessage());

// Fetch method and URI from somewhere
$httpMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
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

// clear flash message
if ($httpMethod === 'GET') {
    flashMessage()->clear();
    errors()->clear();
    input()->clear();
}

$sessionManager->update();