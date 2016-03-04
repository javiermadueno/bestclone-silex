<?php
/**
 * Created by PhpStorm.
 * User: jmadueno
 * Date: 19/02/2016
 * Time: 12:02
 */

namespace BestClone\Domain\Consultas\Modificadores\Municipios;


class ViewMunicipio extends AbstractModificadorMunicipio
{

    protected $commandName = 'ViewMuni';

    public function modify()
    {
        $request = $this->getRequest();

        if(null !== $request->get('Desde', null) ) {
            $stmt = $this->municipiosPorNumeroHabitantes();
        } else {
            $stmt = $this->municipios();
        }

        $this->execute($stmt);
    }

    private function municipiosPorNumeroHabitantes()
    {
        $sql = "exec spViewMuniHabi ?, ?, ?";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(1, $this->getRequest()->get('ID'));
        $stmt->bindValue(2, $this->getRequest()->get('Desde'));
        $stmt->bindValue(4, $this->getRequest()->get('Hasta'));

        return $stmt;
    }

    private function municipios()
    {
        $sql = "exec spViewMuni ?";
        $stmt= $this->db->prepare($sql);

        $stmt->bindValue(1, $this->getRequest()->get('ID'));

        return $stmt;
    }


} 