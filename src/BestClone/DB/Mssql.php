<?php

namespace BestClone\DB;


use PDOStatement;

class Mssql implements DBInterface
{

    /**
     * @var \PDO
     */
    private $conn;

    /**
     * @var \PDOStatement
     */
    private $stmt;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $pass;



    /**
     * @param        $host
     * @param        $bd
     * @param string $user
     * @param string $pass
     */
    function __construct($host, $bd, $user = "sa", $pass = "enblanco")
    {
        $this->host = $host;
        $this->database = $bd;
        $this->user = $user;
        $this->pass = $pass;
        $this->conectar();
    }


    /**
     * @return int
     */
    function conectar()
    {
        if($this->conn instanceof \PDO) {
            return 1;
        }

        $dsn = "sqlsrv:Server={$this->host};Database={$this->database}";
        $this->conn = new \PDO($dsn, $this->user, $this->pass);

        return 1;

    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->conn;
    }

    /**
     * @param $sql
     *
     * @return PDOStatement
     */
    function consulta($sql)
    {
        $this->stmt = $this->conn->prepare($sql);

        return $this->stmt;
    }

    /**
     * @param $sql
     *
     * @return PDOStatement
     */
    public function prepare($sql)
    {
        $this->stmt = $this->conn->prepare($sql);

        return $this->stmt;
    }

    public function query($sql)
    {
        $this->stmt = $this->prepare($sql);

        $this->stmt->execute();

        return  $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function bindParams($params = [])
    {
        foreach($params as $param => $value) {
            $this->stmt->bindValue($param, $value);
        }

        return $this->stmt;
    }

}