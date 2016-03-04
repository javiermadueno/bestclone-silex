<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 6/2/16
 * Time: 20:30
 */

namespace BestClone\Domain\Provincias;


use BestClone\DB\Gateway;

class ProvinciasGateway extends Gateway
{
    /**
     * @return array
     */
    public function selectAll()
    {
        $sql =
            "SELECT
              CP
              ,autonomias.Autonomia AS AUTONOMIA
              ,PROVINCIA
             FROM provincias, AUTONOMIAS
             WHERE autonomias.CCAA = provinciaS.autonomia
             ORDER BY provinciaS.autonomia, provinciaS.cp";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

}