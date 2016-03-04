<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 11:40
 */

namespace BestClone\Domain\Consultas\Modificadores\Localidades;


class AddLocalidad extends AbstractModificadorLocalidades
{

    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spAddLoca ?, ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('IP'));
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('ID'));
        $stmt->bindValue(4, $request->get('Consulta'));

       $this->execute($stmt);

    }



} 