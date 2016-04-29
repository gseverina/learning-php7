<?php

use Silex\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$env = getenv('APP_ENV') ?: 'prod';
#echo $env;

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'dbs.options' => [
        [
            'driver'    => 'pdo_mysql',
            'host'      => '127.0.0.1',
            'dbname'    => 'cookbook',
            'user'      => $app['database']['user'],
            'password'  => $app['database']['password']
        ]
    ]
]);

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
