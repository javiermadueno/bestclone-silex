<?php

use Silex\Application;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use BestClone\DB\Mssql;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());


$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
        return sprintf('%s', ltrim($asset, '/'));
    }));

    return $twig;
}));


$app['db'] = $app->share(function(){

    $host = 'localhost';
    $user = 'sa';
    $pass = '1cc44dm1n';
    $bd   = 'Best_Clone_Familia';

    return new Mssql($host, $bd, $user, $pass);
});

$app['comunidades_gateway'] = $app->share(function() use ($app) {
    return new \BestClone\Domain\CAutonomas\CAutonomasGateway($app['db']);
});

$app['provincias_gateway'] = $app->share(function() use ($app) {
   return new \BestClone\Domain\Provincias\ProvinciasGateway($app['db']);
});

$app['consultas_gateway'] = $app->share(function() use ($app){
   return new \BestClone\Domain\Consultas\ConsultasGateway($app['db']);
});

$app['agrupamiento_gateway'] = $app->share(function() use ($app) {
   return new \BestClone\Domain\Agrupamiento\AgrupamientoGateway($app['db']);
});

$app['modificador_factory'] = function() use ($app) {
  return new \BestClone\Factory\ModificaConsultaFactory($app['db'], $app['twig']);
};


return $app;
