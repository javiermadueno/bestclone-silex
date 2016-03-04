<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 15:00
 */

namespace BestClone\Domain\Consultas\Modificadores\GisX;


class ViewGisX extends AbstractModificadorGisX
{
    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spViewGisX ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('ID'));
        $stmt->bindValue(2, $request->get('Distancia'));

        $this->execute($stmt);
    }

} 