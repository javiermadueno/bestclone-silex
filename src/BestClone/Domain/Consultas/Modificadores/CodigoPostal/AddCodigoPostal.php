<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 23/02/2016
 * Time: 12:10
 */

namespace BestClone\Domain\Consultas\Modificadores\CodigoPostal;


class AddCodigoPostal extends AbstractModificadorCodigoPostal
{

    public function modify()
    {
        $request = $this->getRequest();

        $sql = "exec spAddCCPP ?, ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $request->get('IP'));
        $stmt->bindValue(2, $request->get('User'));
        $stmt->bindValue(3, $request->get('ID'));
        $stmt->bindValue(4, $request->get('Consulta'));

        $this->execute($stmt);

        //TODO: Ejecutar para obtener alerta

    }

} 