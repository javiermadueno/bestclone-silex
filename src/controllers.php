<?php

use BestClone\Domain\Consultas\Modificadores\AbstractModificador;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {

    $comunidades = $app['comunidades_gateway']->selectAll();
    $provincias  = $app['provincias_gateway']->selectAll();

    $productos = $app['db']->query("SELECT * FROM Productos");

    return $app['twig']->render('index.html.twig', [
        'comunidades' => $comunidades,
        'provincias'  => $provincias,
        'productos'   => $productos,
    ]);
})
    ->bind('homepage');


$app->get('/consulta', function (Request $request) use ($app) {

    /** @var AbstractModificador $modificador */
    $modificador = $app['modificador_factory']->getModificador($request);
    $modificador->modify();

    return $modificador->getResult();

})->bind('consultas');


$app->get('/buscar', function (Request $request) use ($app) {

});


$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = [
        'errors/' . $code . '.html',
        'errors/' . substr($code, 0, 2) . 'x.html',
        'errors/' . substr($code, 0, 1) . 'xx.html',
        'errors/default.html',
    ];

    return new Response($app['twig']->resolveTemplate($templates)->render(['code' => $code]), $code);
});
