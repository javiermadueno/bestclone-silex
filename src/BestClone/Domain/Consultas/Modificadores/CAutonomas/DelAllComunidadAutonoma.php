<?php

namespace BestClone\Domain\Consultas\Modificadores\CAutonomas;

use BestClone\Domain\Consultas\Modificadores\AbstractModificador;


class DelAllComunidadAutonoma extends AbstractModificador
{
    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spDelCCAAAll ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->getClientIp());
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('Consulta'));

        $this->execute($stmt);
    }

    public function getResult()
    {
        return $this->getTwig()->render('Consultas/tabla.html.twig', [
            'parametros' => $this->result,
            'funcion'   => 'DelCCAA',
            'indice' => 0
        ]);
    }


}