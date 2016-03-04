<?php

/**
 * Created by PhpStorm.
 * User: javi
 * Date: 4/2/16
 * Time: 0:19
 */
namespace BestClone;

use BestClone\DB\DBInterface;
use BestClone\DB\Mssql;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Login
{
    /**
     * @var Mssql
     */
    private $db;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var Request
     */
    private $request;


    /**
     * @param DBInterface $db
     * @param Request     $request
     */
    public function  __construct(DBInterface $db, Request $request)
    {
        $this->db = $db;
        $this->request = $request;
        $this->session = $request->getSession();
    }

    /**
     * @param $user
     * @param $pass
     *
     * @return bool
     */
    public function checkUserPassword($user, $pass)
    {
        if (isset($user) && isset($pass)) {
            $pass = md5($pass);
            return $this->login($user, $pass);
        }

        $user = $this->session->get('user');
        $pass = $this->session->get('pass');

        if (!isset($user) && !isset($pass)) {
            $this->invaliateSession();
            return false;
        }

        if ((strpos(strtoupper($this->request->getUri()), 'DESCARGA') > 0) && ($this->session->get('nivel') != 2)) {
           return false;
        }

        return true;
    }

    /**
     * @param null|string $user
     * @param null        $pass
     *
     * @return bool
     */
    public function login($user = null, $pass = null)
    {
        $SQL = "select ID, Usuario, Contrasena, Nivel From Usuarios where Usuario = :user and Activa = 1";
        $stmt = $this->db->consulta($SQL);
        $stmt->bindValue('user', $user, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            echo print_r($stmt->errorInfo());

            return false;
        }

        if ($stmt->rowCount() == 0) {
            return false;
        }

        $datos = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (($user == $datos['Usuario']) && ($pass == md5($datos['Contrasena']))) {
            $this->initSession($datos);
        } else {
            return false;
        }

        return true;
    }

    private function initSession($datos)
    {
        $this->session->set('id', $datos['ID']);
        $this->session->set('user', $datos['Usuario']);
        $this->session->set('pass', md5($datos['Contrasena']));
        $this->session->set('nivel', $datos['Nivel']);
    }

    private function invaliateSession()
    {
        $this->session->invalidate();
    }

}