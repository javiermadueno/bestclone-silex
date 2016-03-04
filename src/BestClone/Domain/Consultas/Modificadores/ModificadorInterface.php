<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 11/2/16
 * Time: 19:37
 */

namespace BestClone\Domain\Consultas\Modificadores;


use BestClone\Domain\RequestAwareInterface;

interface ModificadorInterface extends RequestAwareInterface
{

    public function modify();

    public function getResult();
}