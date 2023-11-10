<?php

use App\Router\Router;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';
$loader = new FilesystemLoader(__DIR__ . '/../app/Views');
$twig = new Environment($loader);
$twig->addExtension(new DebugExtension());


$routeInfo = Router::dispatch();

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $template = $twig->load('Error/notFound.twig');
        echo $template->render();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        [$className, $method] = $routeInfo[1];
        $vars = $routeInfo[2];

        $response = (new $className())->{$method}($vars);
        echo $twig->render($response->getViewName() . '.twig', $response->getData());

        break;
}
