<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 14:52
 */

namespace BestClone\Domain\Consultas\Modificadores\Distrito;


class AddDistrito extends AbstractModificadorDistrito
{
    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spAddDist ?, ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('IP'));
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('ID'));
        $stmt->bindValue(4, $request->get('Consulta'));

        $this->execute($stmt);

    }

} 