<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Personal;
use App\Models\Cliente;
use App\Models\OrdenesDeCompra;
use App\Http\Controllers\GastosBancariosController;
use App\Http\Controllers\HorasPersonalController;
use App\Http\Controllers\EnergiaController;
use App\Http\Controllers\CargasSocialesController;
use Illuminate\Support\Facades\Config;



use Illuminate\Http\Request;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Promise\Utils;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $personals = Personal::all();
        $clientes = Cliente::all();
        $ordenesDeCompra = OrdenesDeCompra::all();

        return view('home', compact('personals', 'clientes', 'ordenesDeCompra'));
    }

    public function getConsolidatedDataFromMonth($mesAnio)
{
    try {
        // Crear instancias de los controladores necesarios
        $gastosBancariosController = new GastosBancariosController();
        $horasPersonalController = new HorasPersonalController();
        $energiaController = new EnergiaController();
        $cargasSocialesController = new CargasSocialesController();

        // Llamar a los métodos directamente y obtener las respuestas
        $gastosBancariosResponse = $gastosBancariosController->getGastosBancariosFromMonth($mesAnio);
        $horasPersonalResponse = $horasPersonalController->getHorasPersonalFromMonth($mesAnio);
        $energiaResponse = $energiaController->getEnergiaFromMonth($mesAnio);
        $cargasSocialesResponse = $cargasSocialesController->getCargasSocialesFromMonth($mesAnio);

        // Obtener los datos de las respuestas JSON
        $gastosBancarios = $gastosBancariosResponse->getData(true);
        $horasPersonal = $horasPersonalResponse->getData(true);
        $energia = $energiaResponse->getData(true);
        $cargasSociales = $cargasSocialesResponse->getData(true);


        // Registrar las respuestas para depuración
        Log::info('Respuesta de Gastos Bancarios:', ['response' => $gastosBancarios]);
        Log::info('Respuesta de Horas Personal:', ['response' => $horasPersonal]);
        Log::info('Respuesta de Energía:', ['response' => $energia]);
        Log::info('Respuesta de Cargas Sociales:', ['response' => $cargasSociales]);



        // Combinar los resultados
        $consolidatedData = [
            'gastosBancarios' => $gastosBancarios,
            'horasPersonal' => $horasPersonal,
            'energia' => $energia,
            'cargasSociales' => $cargasSociales,
        ];

        return $consolidatedData;
    } catch (\Exception $e) {
        // Registrar el error para el diagnóstico
        Log::error("Error en getConsolidatedDataFromMonth: " . $e->getMessage());
        return [
            'error' => 'Error al obtener datos consolidados',
            'message' => $e->getMessage(),
        ];
    }
}

public function getOrderDetails($id)
{
    try {
        $clienteBasisId = Config::get('constants.CLIENTE_BASIS');
        $orden = OrdenesDeCompra::with(['cliente', 'horasPersonals', 'insumos'])->findOrFail($id);
        $fechaOrden = Carbon::parse($orden->fecha);
        $fechaActual = Carbon::now();
        
        // Inicializar variables para acumular datos
        $totalGastosBancariosMes = 0;
        $totalHorasPersonalMes = 0;
        $totalHorasEnBlancoMes = 0;
        $masaSalarialEnBlancoMes = 0;
        $totalEnergiaMes = 0;
        $totalCargasSociales = 0;
        $sumaCargasSociales = 0;
        $gastosBasisMes = 0;

        while ($fechaOrden <= $fechaActual) {
            $mesAnio = $fechaOrden->format('m-Y');
            $datosConsolidados = $this->getConsolidatedDataFromMonth($mesAnio);

            if (isset($datosConsolidados['error'])) {
                throw new \Exception($datosConsolidados['message']);
            }

            // Sumar los datos consolidados de cada mes
            $totalGastosBancariosMes += $datosConsolidados['gastosBancarios']['totalPrecio'] ?? 0;
            $totalHorasPersonalMes += $datosConsolidados['horasPersonal']['totalHoras'] ?? 0;
            $totalHorasEnBlancoMes += $datosConsolidados['horasPersonal']['totalHorasEnBlanco'] ?? 0;
            foreach ($datosConsolidados['horasPersonal']['horasPersonalEnBlanco'] as $hora) {
                $masaSalarialEnBlancoMes += $hora['cant_horas'] * $hora['precio_hora_a_fecha_de_carga'];
            }
            $totalEnergiaMes += $datosConsolidados['energia']['totalPrecio'] ?? 0;
            $sumaCargasSociales += $datosConsolidados['cargasSociales']['sumaCargasSociales'] ?? 0;

            // Moverse al próximo mes
            $fechaOrden->addMonth();
        }

        // Cálculos necesarios COLUMNA 1
        $importeOrdenCompra = $orden->valorTarea * 1.21;
        $ingresosBrutos = $importeOrdenCompra * 0.04;
        $impsSHT = $importeOrdenCompra * 0.0045;
        $impuestoCheque = $importeOrdenCompra * 0.012;

        $cantHorasOrden = $orden->cantidad_horas;
        $manoDeObra = $orden->horasPersonals ? $orden->horasPersonals->sum(function($hora) {
            return $hora->precio_hora;
        }) : 0;

        $compras = $orden->insumos ? $orden->insumos->sum('precio') : 0;

        $precioDeLaCargaSocialPorHora = $totalHorasEnBlancoMes != 0 ? $totalCargasSociales / $totalHorasEnBlancoMes : 0;
        $porcentajeDeHorasDeLaOrden = $cantHorasOrden != 0 ? $totalHorasPersonalMes / $cantHorasOrden : 0;
        $energia = $totalEnergiaMes * $porcentajeDeHorasDeLaOrden;
        $gastosBancarios = $totalGastosBancariosMes * $porcentajeDeHorasDeLaOrden;
        $cargasSociales = $precioDeLaCargaSocialPorHora * $cantHorasOrden;
        $totalGastado = $manoDeObra + $compras + $ingresosBrutos + $impsSHT + $impuestoCheque + $energia + $gastosBancarios;
        $saldoPrimario = $importeOrdenCompra - $totalGastado;
        $impGanancias = $saldoPrimario * 0.35;
        $rentabilidad = $saldoPrimario - $impGanancias;
        foreach ($datosConsolidados['horasPersonal']['horasPersonal'] as $hora) {
            if ($hora['orden_de_compra_id'] == $clienteBasisId) {
                $gastosBasisMes += $hora['cant_horas'] * $hora['precio_hora_a_fecha_de_carga'];
            }
        }

        $gastosGenerales = $gastosBasisMes * $porcentajeDeHorasDeLaOrden;

        // Cálculos necesarios COLUMNA 2
        $cargasSocialesYmanoDeObra = $cargasSociales + $manoDeObra;
        $sumaGastos = $energia + $gastosBancarios + $gastosGenerales;

        return response()->json([
            'numeroOrdenInterna' => $orden->numeroOrdenInterna,
            'cliente' => $orden->cliente->nombre,
            'descripcionTarea' => $orden->descripcionTarea,
            'importeOrdenCompra' => number_format($importeOrdenCompra, 2),
            'manoDeObra' => number_format($manoDeObra, 2),
            'compras' => number_format($compras, 2),
            'ingresosBrutos' => number_format($ingresosBrutos, 2),
            'impsSHT' => number_format($impsSHT, 2),
            'impuestoCheque' => number_format($impuestoCheque, 2),
            'totalGastado' => number_format($totalGastado, 2),
            'saldoPrimario' => number_format($saldoPrimario, 2),
            'impGanancias' => number_format($impGanancias, 2),
            'rentabilidad' => number_format($rentabilidad, 2),
            'energia' => number_format($energia, 2),
            'gastosGenerales' => number_format($gastosGenerales, 2),
            'gastosBancarios' => number_format($gastosBancarios, 2),
            'cargasSociales' => number_format($cargasSociales, 2),
            'cargasSocialesYmanoDeObra' => number_format($cargasSocialesYmanoDeObra, 2),
            'sumaGastos' => number_format($sumaGastos, 2),
        ]);
    } catch (\Exception $e) {
        Log::error("Error en getOrderDetails: " . $e->getMessage());
        return response()->json([
            'error' => 'Error al obtener detalles de la orden',
            'message' => $e->getMessage(),
        ]);
    }
}





}
