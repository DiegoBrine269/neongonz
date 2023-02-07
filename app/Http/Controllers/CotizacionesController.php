<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use App\Models\Servicio;
use App\Models\ServicioAutomovil;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class CotizacionesController extends Controller
{
    public function index (Request $request) {
        if($request->isMethod('post')) {
            
            //Recopilando datos del formulario
            $idAgencia = $request->idAgencia;
            $fecha1 = $request->fecha1;
            $fecha2 = $request->fecha2;
            $tipo = $request->tipo;

            //Recopilando lo que se necesita para generar el reporte
            $servicios = Servicio::where('fecha', '>=', $fecha1)->where ('fecha', '<=', $fecha2)->where('idAgencia', '=', $idAgencia)->where ('tipo', '=', $tipo)->get();
            $agencia = Agencia::where('id', '=', $servicios[0]->idAgencia)->get()[0];
            $servicios->subtotal = 0;

            foreach ($servicios as $servicio) {
                // $servicio->listaEconomicos = [];
                $servicio->listaEconomicos = ServicioAutomovil::select('economico')->where('idServicio', '=', $servicio->id)->get();
                $servicio->cantidad = $servicio->listaEconomicos->count();
                $servicio->total = $servicio->cantidad * $servicio->costoUnitario;
                $servicios->subtotal += $servicio->total; 
            }

            // dd($agencia);

            setlocale(LC_ALL, 'es_ES');
            Carbon::setLocale('es');
            $fecha = Date::now();
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $mes = $meses[date('n')-1];
            $fecha = $fecha->formatLocalized('%d de ' . $mes . ' de %Y');
            
            $datos = compact('fecha', 'servicios', 'agencia');
            $pdf = \PDF::loadView('/cotizaciones/reporte', $datos);
            return $pdf->stream('COT.pdf');
            
        } else if($request->isMethod('get')) { 
            $agencias = Agencia::all();
            return view('/cotizaciones/index', [
                'agencias' => $agencias
            ]);

        }
    }
}
