<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 12/2/16
 * Time: 17:29
 */

namespace BestClone\Domain\Consultas\Modificadores\Provincias;


use BestClone\Domain\Consultas\Modificadores\AbstractModificador;

abstract class AbstractModificadorProvincia extends AbstractModificador
{
    protected function bindValues(\PDOStatement $stmt)
    {
        $request = $this->getRequest();

        $stmt->bindValue(1, $request->getClientIp());
        $stmt->bindValue(2, $request->get('User'));

        if (strpos(strtoupper($this->getCommandName()), 'ALL') > 0) {
            $stmt->bindValue(3, $request->get('Consulta'));

            return;
        }

        $stmt->bindValue(3, $request->get('ID'));
        $stmt->bindValue(4, $request->get('Consulta'));
    }

    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'   => 'DelProv',
            'indice' => 0
        ]);
    }


}