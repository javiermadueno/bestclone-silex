<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 11/2/16
 * Time: 19:57
 */

namespace BestClone\Domain\Consultas\Modificadores;


use BestClone\DB\DBInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractModificador implements ModificadorInterface
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var DBInterface
     */
    protected $db;

    /**
     * @var mixed
     */
    protected $result;

    /**
     * @var string
     */
    protected $commandName;

    /**
     * @var
     */
    protected $twig;

    /**
     * @param DBInterface       $db
     * @param \Twig_Environment $twig
     */
    public function __construct(DBInterface $db, \Twig_Environment $twig)
    {
        $this->db = $db;
        $this->twig = $twig;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getCommandName()
    {
        return $this->commandName;
    }

    public function support($command)
    {
        return $this->getCommandName() === $command;
    }

    /**
     * @return mixed
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * @param mixed $twig
     */
    public function setTwig($twig)
    {
        $this->twig = $twig;
    }

    protected function throwException(\PDOStatement $stmt)
    {
        throw new \RuntimeException("Error al ejecutar la consulta '{$stmt->queryString}'. Error: " . print_r($stmt->errorInfo()));
    }

    protected function execute(\PDOStatement $stmt)
    {
        if(!$stmt->execute()) {
            $this->throwException($stmt);
        }

        $this->result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }




    abstract function modify();

    abstract function getResult();


}