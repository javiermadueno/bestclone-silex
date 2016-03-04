<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 19/02/2016
 * Time: 11:59
 */

namespace BestClone\Domain\Consultas\Modificadores\Municipios;


use BestClone\Domain\Consultas\Modificadores\AbstractModificador;

abstract class AbstractModificadorMunicipio extends AbstractModificador
{
    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'   => 'DelMuni',
            'indice' => 0
        ]);
    }

} 