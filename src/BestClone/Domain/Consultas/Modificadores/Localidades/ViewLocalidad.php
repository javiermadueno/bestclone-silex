<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 11:37
 */

namespace BestClone\Domain\Consultas\Modificadores\Localidades;


class ViewLocalidad extends  AbstractModificadorLocalidades
{

    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spViewLoca ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $request->get('ID'));

       $this->execute($stmt);
    }



} 