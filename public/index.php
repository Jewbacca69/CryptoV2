<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\CurrencyController;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute("GET", "/", [new CurrencyController(), "index"]);
    $r->addRoute("GET", "/search", [new CurrencyController(), "search"]);
});

[$httpMethod, $uri] = [$_SERVER['REQUEST_METHOD'], rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))];
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = $routeInfo[1];
        echo $controller->{$method}($routeInfo[2]);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    default:
        echo "404. Not Found.";
}