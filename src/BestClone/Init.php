<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 4/2/16
 * Time: 21:02
 */

namespace BestClone;


use BestClone\DB\DBInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Init
{
    /**
     * @var DBInterface
     */
    private $db;

    /**
     * @var SessionInterface
     */
    private $session;

    /***
     * @param DBInterface $db
     * @param SessionInterface $session
     */
    public function __construct(DBInterface $db, SessionInterface $session)
    {
        $this->db = $db;
        $this->session = $session;
    }


    /**
     * @return bool
     */
    public function init()
    {
        $user = $this->session->get('id');
        $SQL = "exec spInitTablas ?";
        $stmt = $this->db->prepare($SQL);

        $stmt->bindValue(1, $user);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

}