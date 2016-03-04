<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 12:57
 */

namespace BestClone\Domain\Consultas\Modificadores\Distrito;

use BestClone\Domain\Consultas\Modificadores\AbstractModificador;

abstract class AbstractModificadorDistrito extends AbstractModificador
{
    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'    => 'DelDist',
            'indice' => 1
        ]);
    }

} 