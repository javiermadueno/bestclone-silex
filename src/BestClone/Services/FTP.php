<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 6/2/16
 * Time: 19:16
 */

namespace BestClone\Services;


class FTP
{

    /**
     * @var resource
     */
    private $ftp;

    private $host;

    private $port;

    private $user;

    private $pass;

    private $pasivo;

    /**
     * @param           $host
     * @param int       $port
     * @param string    $user
     * @param string    $pass
     * @param bool|true $pasivo
     */
    public function __construct($host, $port = 21, $user = '', $pass = '', $pasivo = true)
    {
        $this->host = $host ;
        $this->port = $port ;
        $this->user = $user ;
        $this->pass = $pass;
        $this->pasivo = $pasivo ;

        $this->connect();

    }

    public function connect()
    {
        $this->ftp = ftp_connect($this->host, $this->port);
        ftp_login($this->ftp, $this->user, $this->pass);
        ftp_pasv($this->ftp, $this->pasivo);
    }

    public function close()
    {
        ftp_close($this->ftp);
    }


    public function upload($archivo, $destino)
    {
        ftp_put($this->ftp, $destino, $archivo, FTP_BINARY);
        $this->close();
    }
}