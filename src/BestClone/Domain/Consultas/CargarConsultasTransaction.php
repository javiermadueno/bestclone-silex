<?php


namespace BestClone\Domain\Consultas;

use BestClone\Domain\Agrupamiento\AgrupamientoGateway;
use Symfony\Component\HttpFoundation\Request;

class CargarConsultasTransaction
{
    /**
     * @var ConsultasGateway
     */
    private $consultasGateway;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var
     */
    private $agrupamientoGateway;

    private $funcionesJS = [
        "CCAAResultado" => 'DelCCAA',
        "ProvResultado" => 'DelProv',
        "MuniResultado" => 'DelMuni',
        "LocaResultado" => 'DelLoca',
        "CCPPResultado" => 'DelCCPP',
        "CallResultado" => 'DelCall',
        "DistResultado" => 'DelDist',
        "GisXResultado" => 'DelGisX'
    ];

    private $indices = [
        "CCAAResultado" => 0,
        "ProvResultado" => 0,
        "MuniResultado" => 0,
        "LocaResultado" => 0,
        "CCPPResultado" => 1,
        "CallResultado" => 1,
        "DistResultado" => 1,
        "GisXResultado" => 1
    ];

    private $result = [];

    /**
     * @param ConsultasGateway    $consultasGateway
     * @param \Twig_Environment   $twig
     * @param AgrupamientoGateway $agrupamientoGateway
     */
    public function __construct(
        ConsultasGateway $consultasGateway,
        \Twig_Environment $twig,
        AgrupamientoGateway $agrupamientoGateway
    ) {
        $this->consultasGateway = $consultasGateway;
        $this->agrupamientoGateway = $agrupamientoGateway;
        $this->twig = $twig;
    }


    public function cargaConsulta(Request $request)
    {
        $user = $request->get('User');
        $consulta = $request->request->getInt('Consulta');

        $tipos = $this
            ->consultasGateway
            ->cargarConsulta($user, $consulta);

        $this->result = [];

        $this->result['Consulta'] = (string) $consulta;

        $i = 0;

        foreach ($tipos as $tipo => $rowset) {

            if ($tipo == 'Resultado') {
                $this->calculaResultado($rowset);
                continue;
            }

            $this->result[$tipo] = $this->generateTable($rowset, $tipo);
            $this->result["Seleccion{$i}"] = $this->calculaSeleccion($rowset, $tipo);;
            $i++;
        }

        return $this->result;

    }

    protected function calculaResultado($rowset)
    {
        $rowset = $rowset[0];

        $keys = array_keys($rowset);

        $this->result['Nombre'] = $rowset[$keys[0]];
        $this->result['Observaciones'] = $rowset[$keys[1]];
        $this->result['Filtro'] = $rowset[$keys[4]] . $rowset[$keys[5]] . $rowset[$keys[6]] . $rowset[$keys[7]];

        $agrupamientos = $rowset[$keys[2]];
        $orden = $rowset[$keys[3]];

        $this->result['Disponibles'] = $this
            ->renderSelect(
                $this->agrupamientoGateway
                    ->selectCamposDisponibles($agrupamientos), 'Disponibles');

        $this->result['Seleccionados'] = $this
            ->renderSelect(
                $this->agrupamientoGateway
                ->selectCamposSeleccionados($agrupamientos), 'Seleccionados');

        $this->result['Orden'] = $this
            ->renderSelect(
                $this->agrupamientoGateway
                    ->selectCamposSeleccionados($orden), 'Orden');

    }


    protected function renderSelect($agrupamientos, $tipo)
    {
        $html = $this
            ->twig
            ->render('Agrupamientos/select.html.twig', [
                'agrupamientos' => $agrupamientos,
                'tipo'          => $tipo
            ]);

        $html = trim(preg_replace(['/\s{2,}/', '/[\t\n]/'], ' ', $html));

        return $html;
    }

    protected function generateTable($rowset, $tipo)
    {
        $funcion = $this->funcionesJS[$tipo];
        $indice = $this->indices[$tipo];

        $html = $this->twig->render('Consultas/tabla.html.twig', [
            'parametros' => $rowset,
            'funcion'    => $funcion,
            'indice'     => $indice
        ]);

        $html = trim(preg_replace(['/\s{2,}/', '/[\t\n]/'], ' ', $html));

        return empty($html) ? null : $html;
    }

    protected function calculaSeleccion($rowset, $tipo)
    {
        $seleccion = '';

        $funcion = $this->funcionesJS[$tipo];

        foreach ($rowset as $parametro) {
            $keys = array_keys($parametro);

            if ($funcion == 'DelDist') {
                $seleccion .= sprintf("%s-%s, ", $parametro[$keys[1]], $parametro[$keys[2]]);
            } else {
                $seleccion .= sprintf("%s, ", $parametro[$keys[1]]);
            }
        }

        $seleccion = rtrim(trim($seleccion), ',');

        return empty($seleccion) ? null : $seleccion;
    }


}