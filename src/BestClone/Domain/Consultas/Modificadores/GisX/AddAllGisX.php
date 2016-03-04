<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 15:06
 */

namespace BestClone\Domain\Consultas\Modificadores\GisX;


class AddAllGisX extends AbstractModificadorGisX
{
    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spAddGisXAll ?, ?, ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('IP'));
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('ID'));
        $stmt->bindValue(4, $request->get('Consulta'));
        $stmt->bindValue(5, $request->get('Distancia'));

        $this->execute($stmt);
    }

} 