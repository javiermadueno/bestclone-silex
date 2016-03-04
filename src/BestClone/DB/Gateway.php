<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 6/2/16
 * Time: 20:31
 */

namespace BestClone\DB;


class Gateway
{
    /**
     * @var DBInterface
     */
    protected $db;

    /**
     * Gateway constructor.
     */
    public function __construct(DBInterface $db)
    {
        $this->db = $db;
    }
}