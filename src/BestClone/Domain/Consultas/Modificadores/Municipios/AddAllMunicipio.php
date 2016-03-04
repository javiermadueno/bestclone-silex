<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 19/02/2016
 * Time: 12:24
 */

namespace BestClone\Domain\Consultas\Modificadores\Municipios;


class AddAllMunicipio extends AbstractModificadorMunicipio
{

    protected $commandName = 'AddMuniAll';

    public function  modify()
    {
        $SQL = "exec spAddMuniAll ?, ?, ?, ?, ?, ?";

        $stmt = $this->db->prepare($SQL);

        $stmt->bindValue(1, $this->getRequest()->get('IP'));
        $stmt->bindValue(1, $this->getRequest()->get('User'));
        $stmt->bindValue(1, $this->getRequest()->get('ID'));
        $stmt->bindValue(1, $this->getRequest()->get('Desde'));
        $stmt->bindValue(1, $this->getRequest()->get('Hasta'));
        $stmt->bindValue(1, $this->getRequest()->get('Consulta'));

        $this->execute($stmt);
    }


} 