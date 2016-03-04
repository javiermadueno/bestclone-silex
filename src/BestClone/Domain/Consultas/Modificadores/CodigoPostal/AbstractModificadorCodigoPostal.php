<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 12:04
 */

namespace BestClone\Domain\Consultas\Modificadores\CodigoPostal;


use BestClone\Domain\Consultas\Modificadores\AbstractModificador;

abstract class AbstractModificadorCodigoPostal extends AbstractModificador
{

    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'    => 'DelCCPP',
            'indice' => 1
        ]);
    }

} 