<?php
require '../vendor/autoload.php';

use Slim\App as App;


// Prepare app
$container = new Slim\Container() ;

$container['config'] = function($c){
    return \BurningDiode\Slim\Config\Yaml::getInstance()
        ->addParameters($c->get('settings'))
        ->addFile("../app/config/config_prod.yml");
};


foreach ($container->get('config')->get('services') as $name => $serviceParams) {

    $serviceParams['name'] = $name;

    $container[$name] = function($c) use($serviceParams){
        if(!array_key_exists('class', $serviceParams)){
            throw new \Exception("Cannot create service when no class is given");
        }
        $service = new ServiceReference($serviceParams);
        return $service->getService();
    };
}


$app = new App($container);


// Replace Slim config system with Yaml config
//\BurningDiode\Slim\Config\Yaml::getInstance()->addFile("../app/config/config_prod.yml");

// Create monolog logger and store logger in container as singleton 
// (Singleton resources retrieve the same log resource definition each time)
//$app->container->singleton('log', function () {
//    $log = new \Monolog\Logger('slim-skeleton');
//    $log->pushHandler(new \Monolog\Handler\StreamHandler('../app/logs/app.log', \Monolog\Logger::DEBUG));
//    return $log;
//});

// Prepare view
//$app->view(new \Slim\Views\Twig());
//$app->view->parserOptions = array(
//    'charset' => 'utf-8',
//    'cache' => realpath('../app/cache/twig'),
//    'auto_reload' => true,
//    'strict_variables' => false,
//    'autoescape' => true
//);
//$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());
//
//// Define routes
//$app->addRoutes(array(
//    '/' => '\\AppBundle\\Controller\\Index:index'
//));

$app->get('/', function($request, $response){

    $helloWorldService1 = $this->__get('app.write.word');

    $helloWorldService2 = $this->__get('app.write.word');

    $response->write($helloWorldService1->write("Hello World Yo!"));

    $response->write($helloWorldService2->write());


    return $response;
});

// Run app
$app->run();
