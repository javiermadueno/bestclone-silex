<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 12/2/16
 * Time: 17:26
 */

namespace BestClone\Domain\Consultas\Modificadores\Provincias;


class AddAllProvincia extends AbstractModificadorProvincia
{
    protected $commandName = 'AddProvinciasAll';


    function modify()
    {
        $sql = "exec spAddProvAll ?, ?, ?";

        $stmt = $this->db->prepare($sql);
        $this->bindValues($stmt);

        $this->execute($stmt);

    }


}