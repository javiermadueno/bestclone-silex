<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 6/2/16
 * Time: 17:31
 */

namespace BestClone\Domain\CAutonomas;


use BestClone\DB\Gateway;

class CAutonomasGateway extends Gateway
{

    public function selectAll()
    {
        $SQL = "Select CCAA, AUTONOMIA from autonomias";
        $stmt = $this->db->prepare($SQL);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }





}