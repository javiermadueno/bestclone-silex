<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 19/02/2016
 * Time: 12:37
 */

namespace BestClone\Domain\Consultas\Modificadores\Localidades;


use BestClone\Domain\Consultas\Modificadores\AbstractModificador;

abstract class AbstractModificadorLocalidades extends AbstractModificador
{

    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'   => 'DelLoca',
            'indice' => 0
        ]);
    }

} 