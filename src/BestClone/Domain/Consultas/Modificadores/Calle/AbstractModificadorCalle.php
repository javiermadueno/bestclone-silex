<?php



namespace BestClone\Domain\Consultas\Modificadores\Calle;

use BestClone\Domain\Consultas\Modificadores\AbstractModificador;

abstract class AbstractModificadorCalle extends AbstractModificador
{

    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'    => 'DelCall',
            'indice' => 1
        ]);
    }
} 