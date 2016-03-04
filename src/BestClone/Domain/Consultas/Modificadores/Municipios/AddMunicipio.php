<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 19/02/2016
 * Time: 12:15
 */

namespace BestClone\Domain\Consultas\Modificadores\Municipios;


class AddMunicipio extends AbstractModificadorMunicipio
{

    protected $commandName = 'AddMuni';

    public function modify()
    {
        $SQL = "exec spAddMuni ?, ?, ?, ?";

        $stmt = $this->db->prepare($SQL);

        $stmt->bindValue(1, $this->getRequest()->get('IP'));
        $stmt->bindValue(2, $this->getRequest()->get('User'));
        $stmt->bindValue(3, $this->getRequest()->get('ID'));
        $stmt->bindValue(4, $this->getRequest()->get('Consulta'));

        $this->execute($stmt);

        //TODO: Ejecutar para obtener alerta
    }



} 