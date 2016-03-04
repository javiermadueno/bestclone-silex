<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 12/2/16
 * Time: 17:26
 */

namespace BestClone\Domain\Consultas\Modificadores\Provincias;



class DelProvincia extends AbstractModificadorProvincia
{
    protected $commandName = 'DelProv';


    function modify()
    {
        $sql = "exec spDelProv ?, ?, ?, ?";

        $stmt = $this->db->prepare($sql);
        $this->bindValues($stmt);

       $this->execute($stmt);

    }

}