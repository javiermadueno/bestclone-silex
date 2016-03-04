<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 11/2/16
 * Time: 19:56
 */

namespace BestClone\Domain\Consultas\Modificadores\CAutonomas;

use BestClone\Domain\Consultas\Modificadores\AbstractModificador;


class AddComunidadAutonoma extends AbstractModificador
{
    protected $result;

    public function modify()
    {
        $request = $this->getRequest();

        $sql = "EXEC spAddCCAA ?, ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->getClientIp());
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('ID'));
        $stmt->bindValue(4, $request->get('Consulta'));

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