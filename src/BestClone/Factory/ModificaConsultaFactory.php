<?php
/**
 * Created by PhpStorm.
 * User: javi
 * Date: 11/2/16
 * Time: 19:32
 */

namespace BestClone\Factory;


use BestClone\DB\DBInterface;
use BestClone\Domain\Consultas\Modificadores\AbstractModificador;
use BestClone\Domain\Consultas\Modificadores\Calle\AddCalle;
use BestClone\Domain\Consultas\Modificadores\Calle\DelCalle;
use BestClone\Domain\Consultas\Modificadores\Calle\DellAllCalle;
use BestClone\Domain\Consultas\Modificadores\Calle\ViewCalle;
use BestClone\Domain\Consultas\Modificadores\CAutonomas\AddComunidadAutonoma;
use BestClone\Domain\Consultas\Modificadores\CAutonomas\DelAllComunidadAutonoma;
use BestClone\Domain\Consultas\Modificadores\CAutonomas\DelComunidadAutonoma;
use BestClone\Domain\Consultas\Modificadores\CodigoPostal\AddCodigoPostal;
use BestClone\Domain\Consultas\Modificadores\CodigoPostal\DelCodigoPostal;
use BestClone\Domain\Consultas\Modificadores\CodigoPostal\DellAllCodigoPostal;
use BestClone\Domain\Consultas\Modificadores\CodigoPostal\ViewCodigoPostal;
use BestClone\Domain\Consultas\Modificadores\Distrito\AddDistrito;
use BestClone\Domain\Consultas\Modificadores\Distrito\DelAllDistrito;
use BestClone\Domain\Consultas\Modificadores\Distrito\DelDistrito;
use BestClone\Domain\Consultas\Modificadores\Distrito\ViewDistrito;
use BestClone\Domain\Consultas\Modificadores\GisX\AddAllGisX;
use BestClone\Domain\Consultas\Modificadores\GisX\AddGisX;
use BestClone\Domain\Consultas\Modificadores\GisX\DelAllGisX;
use BestClone\Domain\Consultas\Modificadores\GisX\DelGisX;
use BestClone\Domain\Consultas\Modificadores\GisX\ViewGisX;
use BestClone\Domain\Consultas\Modificadores\Localidades\AddAllLocalidad;
use BestClone\Domain\Consultas\Modificadores\Localidades\AddLocalidad;
use BestClone\Domain\Consultas\Modificadores\Localidades\DelAllLocalidad;
use BestClone\Domain\Consultas\Modificadores\Localidades\DelLocalidad;
use BestClone\Domain\Consultas\Modificadores\Localidades\ViewLocalidad;
use BestClone\Domain\Consultas\Modificadores\Municipios\AddAllMunicipio;
use BestClone\Domain\Consultas\Modificadores\Municipios\AddMunicipio;
use BestClone\Domain\Consultas\Modificadores\Municipios\DelAllMunicipio;
use BestClone\Domain\Consultas\Modificadores\Municipios\DelMunicipio;
use BestClone\Domain\Consultas\Modificadores\Municipios\ViewMunicipio;
use BestClone\Domain\Consultas\Modificadores\Provincias\AddAllProvincia;
use BestClone\Domain\Consultas\Modificadores\Provincias\AddProvincia;
use BestClone\Domain\Consultas\Modificadores\Provincias\DelAllProvincia;
use BestClone\Domain\Consultas\Modificadores\Provincias\DelProvincia;
use Symfony\Component\HttpFoundation\Request;

class ModificaConsultaFactory
{
    /**
     * @var AbstractModificador[]
     */
    private $modificadores = [
        'AddCCAA'    => AddComunidadAutonoma::class,
        'DelCCAA'    => DelComunidadAutonoma::class,
        'DelCCAAAll' => DelAllComunidadAutonoma::class,
        'AddProv'    => AddProvincia::class,
        'AddProvAll' => AddAllProvincia::class,
        'DelProv'    => DelProvincia::class,
        'DelProvAll' => DelAllProvincia::class,
        'ViewLoca'   => ViewLocalidad::class,
        'AddLoca'    => AddLocalidad::class,
        'AddLocaAll' => AddAllLocalidad::class,
        'DelLoca'    => DelLocalidad::class,
        'DelLocaAll' => DelAllLocalidad::class,
        'ViewCCPP'   => ViewCodigoPostal::class,
        'AddCCPP'    => AddCodigoPostal::class,
        'DelCCPP'    => DelCodigoPostal::class,
        'DelCCPPAll' => DellAllCodigoPostal::class,
        'ViewCall'   => ViewCalle::class,
        'AddCall'    => AddCalle::class,
        'DelCall'    => DelCalle::class,
        'DelCallAll' => DellAllCalle::class,
        'ViewDist'   => ViewDistrito::class,
        'AddDist'    => AddDistrito::class,
        'DelDist'    => DelDistrito::class,
        'DelDistAll' => DelAllDistrito::class,
        'ViewGisX'   => ViewGisX::class,
        'AddGisX'    => AddGisX::class,
        'AddGisXAll' => AddAllGisX::class,
        'DelGisX'    => DelGisX::class,
        'DelGisXAll' => DelAllGisX::class,
        'ViewMuni'   => ViewMunicipio::class,
        'AddMuni'    => AddMunicipio::class,
        'AddMuniAll' => AddAllMunicipio::class,
        'DelMuni'    => DelMunicipio::class,
        'DelMuniAll' => DelAllMunicipio::class,
    ];

    /**
     * @var DBInterface
     */
    private $db;


    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param DBInterface       $db
     * @param \Twig_Environment $twig
     */
    public function __construct(DBInterface $db, \Twig_Environment $twig)
    {
        $this->db   = $db;
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     *
     * @return AbstractModificador
     */
    public function getModificador(Request $request)
    {
        $tipo = $request->get('tipo');

        if (!isset($this->modificadores[$tipo])) {
            throw new \InvalidArgumentException("Modificador del tipo {$tipo} no soportado");
        }

        $class = $this->modificadores[$tipo];

        /** @var AbstractModificador $modificador */
        $modificador = new $class($this->db, $this->twig);
        $modificador->setRequest($request);

        return $modificador;
    }

}