<?php
require '../vendor/autoload.php';

use SlimController\Slim as Slim;

// Prepare app
$app = new Slim();

// Replace Slim config system with Yaml config
\BurningDiode\Slim\Config\Yaml::getInstance()->addFile("../app/config/config_prod.yml");

// Create monolog logger and store logger in container as singleton 
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../app/logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../app/cache/twig'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

// Define routes
$app->addRoutes(array(
    '/' => '\\AppBundle\\Controller\\Index:index'
));

// Run app
$app->run();
