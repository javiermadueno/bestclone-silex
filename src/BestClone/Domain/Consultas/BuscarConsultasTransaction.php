<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 7/2/16
 * Time: 18:52
 */

namespace BestClone\Domain\Consultas;


use Symfony\Component\HttpFoundation\Request;

class BuscarConsultasTransaction
{

    private $consyltasGateway;

    private $twig;

    public function __construct(ConsultasGateway $consultasGateway, \Twig_Environment $twig)
    {
        $this->consyltasGateway = $consultasGateway;
        $this->twig = $twig;
    }

    public function buscaConsultas(Request $request)
    {
        $user = $request->get('User');
        $desde= $request->get('Desde');
        $hasta = $request->get('Hasta');

        list($day, $mon, $year) = explode('/', $hasta);
        $hasta = date('d/m/Y', mktime(0, 0, 0, $mon, $day + 1, $year));

        $consultas = $this
            ->consyltasGateway
            ->buscarConsultas($user, $desde, $hasta);

        return $this
            ->twig
            ->render('Consultas/tabla_busqueda_consultas.html.twig', [
                    'consultas' => $consultas
                ]);
    }

}