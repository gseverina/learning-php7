<?php

use Silex\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$env = getenv('APP_ENV') ?: 'prod';
#echo $env;

$app->register(
    new Igorw\Silex\ConfigServiceProvider(
        __DIR__ . "/../config/$env.json"
    )
);

$app->register(
    new Silex\Provider\TwigServiceProvider(),
    ['twig.path' => __DIR__ . '/../views']
);

$app->register(
    new Silex\Provider\MonologServiceProvider(),
    ['monolog.logfile' => '/var/log/app.log']
);

$app->get('/', function(Application $app) {
    return $app['twig']->render('home.twig');
});


$app->run();
