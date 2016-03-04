<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 14:34
 */

namespace BestClone\Domain\Consultas\Modificadores\Calle;


class ViewCalle extends AbstractModificadorCalle
{
    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spViewCall ?, ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $request->get('ID'));
        $stmt->bindValue(3, $request->get('ID2'));

        $this->execute($stmt);
    }

} 