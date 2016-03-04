<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 19/02/2016
 * Time: 12:32
 */

namespace BestClone\Domain\Consultas\Modificadores\Municipios;


class DelAllMunicipio extends AbstractModificadorMunicipio
{
    protected $commandName = 'DelMuniAll';

    public function modify()
    {
        $sql = "exec spDelMuniAll ?, ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $this->getRequest()->get('IP'));
        $stmt->bindValue(2, $this->getRequest()->get('User'));
        $stmt->bindValue(1, $this->getRequest()->get('Consulta'));

        $this->execute($stmt);

    }

} 