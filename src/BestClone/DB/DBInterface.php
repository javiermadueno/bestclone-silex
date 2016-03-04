<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 6/2/16
 * Time: 14:00
 */

namespace BestClone\DB;


interface DBInterface
{
    /**
     * @param $sql
     *
     * @return \PDOStatement
     */
    public function prepare($sql);

    /**
     * @param array $params
     *
     * @return \PDOStatement
     */
    public function bindParams($params = []);


    /**
     * @return bool
     */
    public function execute();


    /**
     * @param $sql
     *
     * @return \PDOStatement
     */
    public function query($sql);
}