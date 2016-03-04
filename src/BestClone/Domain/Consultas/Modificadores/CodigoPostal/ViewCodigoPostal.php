<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 12:08
 */

namespace BestClone\Domain\Consultas\Modificadores\CodigoPostal;


class ViewCodigoPostal extends AbstractModificadorCodigoPostal
{

    public function modify()
    {
        $request = $this->getRequest();

        $sql  = "exec spViewCCPP ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $request->get('ID'));

        $this->execute($stmt);
    }

} 