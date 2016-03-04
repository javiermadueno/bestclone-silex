<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 14:37
 */

namespace BestClone\Domain\Consultas\Modificadores\Calle;


class AddCalle extends AbstractModificadorCalle
{
    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spAddCall ?, ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('IP'));
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('ID'));
        $stmt->bindValue(4, $request->get('Consulta'));

        $this->execute($stmt);

    }

} 