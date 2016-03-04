<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 14:42
 */

namespace BestClone\Domain\Consultas\Modificadores\Calle;


class DellAllCalle extends AbstractModificadorCalle
{

    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spDelCallAll ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('IP'));
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('Consulta'));

        $this->execute($stmt);
    }

} 