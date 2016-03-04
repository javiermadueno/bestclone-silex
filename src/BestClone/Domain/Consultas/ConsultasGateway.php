<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 6/2/16
 * Time: 17:44
 */

namespace BestClone\Domain\Consultas;


use BestClone\DB\Gateway;
use Symfony\Component\HttpFoundation\Request;
use PDO;

class ConsultasGateway extends Gateway
{


    private $rowsets = [
        "CCAAResultado",
        "ProvResultado",
        "MuniResultado",
        "LocaResultado",
        "CCPPResultado",
        "CallResultado",
        "DistResultado",
        "GisXResultado",
        "Resultado"
    ];


    /**
     * @param Request $request
     *
     * @return int|mixed
     */
    public function guardarConsulta(Request $request)
    {
        $stmt = $this->db->prepare(
            "exec spGuardaConsulta :ip, :user, :consulta, :nombre, :observaciones, :campos, :orden, :filtro, :id"
        );

        /**
        $stmt = $this->db->query(
            "exec spGuardaConsulta
                {$request->getClientIp()},
                {$request->get('User')},
                {$request->get('Consulta')},
                {$request->get('Nombre')},
                {$request->get('Observaciones')},
                {$request->get('Campos')},
                {$request->get('Orden')},
                {$request->get('Filtro')},
                @ID"
        );

        $stmt = $this->db->query("SELECT @ID")
         */


        $id = 0;

        $stmt->bindValue('ip', $request->getClientIp());
        $stmt->bindValue('user', $request->get('User'));
        $stmt->bindValue('consulta', $request->get('Consulta'));
        $stmt->bindValue('nombre', $request->get('Nombre'));
        $stmt->bindValue('observaciones', $request->get('Observaciones'));
        $stmt->bindValue('campos', $request->get('Campos'));
        $stmt->bindValue('orden', $request->get('Orden'));
        $stmt->bindValue('filtro', $request->get('Filtro'));
        $stmt->bindParam('id', $id, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4000);

        if (!$stmt->execute()) {
            return print_r($stmt->errorInfo());
        }

        //$stmt->bindColumn(1, $id, \PDO::PARAM_INT);
        $result = $stmt->fetchAll();


        return $result;
    }

    /**
     * @param $user
     * @param int $consulta
     *
     * @return array|null
     */
    public function cargarConsulta($user, $consulta = 0)
    {
        $stmt = $this->db->prepare(
            "exec spCargaConsulta :user, :consulta"
        );

        $stmt->bindValue(':user', $user);
        $stmt->bindValue(':consulta', $consulta, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            echo print_r($stmt->errorInfo());
            return null;
        }

        $result = [];

        foreach ($this->rowsets as $paso) {
            $rowset = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $result[$paso] = $rowset;
            if (!$stmt->nextRowset()) {
                break;
            }
        }

        return $result;
    }

    /**
     * @param $user
     * @param $desde
     * @param $hasta
     *
     * @return array
     */
    public function buscarConsultas($user, $desde, $hasta)
    {
        $stmt = $this->db->prepare(
            "EXEC spBuscaConsulta :user, :desde, :hasta"
        );

        $desde = $this->prepareDate($desde);
        $hasta = $this->prepareDate($hasta);

        $stmt->bindValue('user', $user);
        $stmt->bindValue('desde', $desde);
        $stmt->bindValue('hasta', $hasta);

        $res = [];

        if ($stmt->execute()) {
            $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $res;
    }

    /**
     * @param $user
     * @param $consulta
     *
     * @return bool
     */
    public function borrarConsulta($user, $consulta)
    {
        $sql = "EXEC spBorrarConsulta :user, :consulta";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('user', $user);
        $stmt->bindValue('consulta', $consulta);

        if(!$stmt->execute()) {
            return false;
        }

        return true;
    }

    private function prepareDate($date = '')
    {
        $date = \DateTime::createFromFormat('d/m/Y', $date);
        return $date->format('m/d/Y');
    }

}