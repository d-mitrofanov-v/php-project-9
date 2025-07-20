<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;
use Slim\Views\PhpRenderer;

require __DIR__ . "/../vendor/autoload.php";

$container = new Container();
$container->set('renderer', function () {
    return new PhpRenderer(__DIR__ . "/../templates");
});

$app = AppFactory::createFromContainer($container);
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, $args) {
    return $this->get('renderer')->render($response, 'home.phtml');
});

$app->run();
