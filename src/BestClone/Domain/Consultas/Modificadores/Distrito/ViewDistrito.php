<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 14:49
 */

namespace BestClone\Domain\Consultas\Modificadores\Distrito;


class ViewDistrito extends AbstractModificadorDistrito
{

    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spViewDist ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('ID'));

        $this->execute($stmt);

    }

} 