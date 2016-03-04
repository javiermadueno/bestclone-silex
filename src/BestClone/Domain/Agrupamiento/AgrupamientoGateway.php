<?php

namespace BestClone\Domain\Agrupamiento;


use BestClone\DB\Gateway;

class AgrupamientoGateway extends Gateway
{

    public function selectAll()
    {
        $SQL = "SELECT * FROM Agrupamiento";

        $stmt = $this->db->prepare($SQL);

        if (!$stmt->execute()) {
            return [];
        }

        if (!$agrupamientos = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
            return [];
        }

        $stmt->closeCursor();

        return $agrupamientos;
    }

    /**
     * @param $agrupamiento
     *
     * @return array|mixed
     */
    public function selectAgrupamiento($agrupamiento)
    {
        $SQL = "SELECT * FROM Agrupamiento where ID = :agrupamiento";

        $stmt = $this->db->prepare($SQL);
        $stmt->bindValue('agrupamiento', $agrupamiento);

        if (!$stmt->execute()) {
            return [];
        }

        if (!$agrupamiento = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return [];
        }

        $stmt->closeCursor();

        return $agrupamiento;
    }


    public function selectCamposDisponibles($agrupamientos = '')
    {
        $SQL = "select * from Agrupamiento where ID not in (";

        $agrupamientos = explode(';', $agrupamientos);

        foreach ($agrupamientos as $agrupamiento) {
            $SQL .= "?, ";
        }

        $SQL = rtrim(trim($SQL), ',') . ')';

        $stmt = $this->db->prepare($SQL);

        for ($i = 0 ; $i < count($agrupamientos); $i++) {
            $stmt->bindValue($i+1, $agrupamientos[$i]);
        }

        $stmt->execute();

        $agrupamientos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        return $agrupamientos;

    }


    public function selectCamposSeleccionados($agrupamientos = '')
    {
        $SQL = "SELECT * FROM Agrupamiento WHERE ID IN (";

        $agrupamientos = explode(';', $agrupamientos);

        foreach ($agrupamientos as $agrupamiento) {
            $SQL .= "?, ";
        }

        $SQL = rtrim(trim($SQL), ',') . ')';

        $stmt = $this->db->prepare($SQL);

        for ($i = 0 ; $i < count($agrupamientos); $i++) {
            $stmt->bindValue($i+1, $agrupamientos[$i]);
        }


        $stmt->execute();

        $agrupamientos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $stmt->closeCursor();


        return $agrupamientos;

    }

    protected function calculaCondicion($agrupamientos = '')
    {
        $condicion = '';

        $agrupamientos = explode(';', $agrupamientos);

        foreach ($agrupamientos as $agrupamiento) {
            $condicion .= "'{$agrupamiento}', ";
        }
        $condicion = rtrim(trim($condicion), ',');

        return $condicion;
    }

}