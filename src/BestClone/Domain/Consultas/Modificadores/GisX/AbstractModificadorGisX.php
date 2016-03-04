<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 12:58
 */

namespace BestClone\Domain\Consultas\Modificadores\GisX;


use BestClone\Domain\Consultas\Modificadores\AbstractModificador;

abstract class AbstractModificadorGisX extends AbstractModificador
{
    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'    => 'DelGisX',
            'indice' => 1
        ]);
    }

} 