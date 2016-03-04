<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 15:09
 */

namespace BestClone\Domain\Consultas\Modificadores\GisX;


class DelAllGisX extends AbstractModificadorGisX
{
    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spDelGisXAll ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('IP'));
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('Consulta'));

        $this->execute($stmt);
    }

} 