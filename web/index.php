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
#print_r($app);
