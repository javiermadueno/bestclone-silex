<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 19/02/2016
 * Time: 12:28
 */

namespace BestClone\Domain\Consultas\Modificadores\Municipios;


class DelMunicipio extends AbstractModificadorMunicipio
{

    protected $commandName = 'DelMuni';

    public function modify()
    {
        $SQL = "exec spDelMuni ?, ?, ?, ?";

        $stmt = $this->db->prepare($SQL);

        $stmt->bindValue(1, $this->getRequest()->get('IP'));
        $stmt->bindValue(2, $this->getRequest()->get('User'));
        $stmt->bindValue(3, $this->getRequest()->get('ID'));
        $stmt->bindValue(4, $this->getRequest()->get('Consulta'));

        $this->execute($stmt);
    }

} 