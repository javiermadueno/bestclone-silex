<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 11/2/16
 * Time: 19:54
 */

namespace BestClone\Domain;


use Symfony\Component\HttpFoundation\Request;

interface RequestAwareInterface
{

    public function setRequest(Request $request);

    public function getRequest();

}