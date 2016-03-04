<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 12/2/16
 * Time: 17:27
 */

namespace BestClone\Domain\Consultas\Modificadores\Provincias;



class DelAllProvincia extends AbstractModificadorProvincia
{
    protected $commandName = 'DelProvinciasAll';


    function modify()
    {
        $sql = "exec spDelProvAll ?, ?, ?";

        $stmt = $this->db->prepare($sql);
        $this->bindValues($stmt);

        $this->execute($stmt);

    }

}