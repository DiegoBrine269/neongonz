<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use App\Models\Automovil;
use App\Models\Servicio;
use App\Models\ServicioAutomovil;
use Exception;
use Illuminate\Http\Request;

class ServicesController extends Controller
{

    public function index (Request $request) {
        if($request->isMethod('post')) { 

        } else if($request->isMethod('get')) {

            $servicios = Servicio::select('servicios.id', 'agencias.nombre', 'concepto', 'costoUnitario', 'fecha' )->join('agencias', 'servicios.idAgencia', '=', 'agencias.id')->orderBy('fecha', 'desc')->get();
            // dd($servicios);

            return view('/servicios/index', [
                'servicios' => $servicios
            ]);
        }
    }

    public function nuevo (Request $request) {
        if($request->isMethod('post')) { 
            $nuevoServicio = new Servicio();
            $nuevoServicio->idAgencia = $request->idAgencia;
            $nuevoServicio->concepto = $request->concepto;
            $nuevoServicio->tipo = $request->tipo;
            $nuevoServicio->costoUnitario = $request->costoUnitario; 
            $nuevoServicio->fecha = $request->fecha;
            
            // dd($nuevoServicio);

            $nuevoServicio->save();

            return redirect('/servicios/servicio?id=' . $nuevoServicio->id );

        } else if($request->isMethod('get')) {

            $agencias = Agencia::all();
            
            
            return view('/servicios/nuevo', [
                'agencias' => $agencias
            ]);
        }
    }


    public function consultar (Request $request) {

        if($request->isMethod('post')) { 
            $servicioAutomovil = new ServicioAutomovil();
            $servicioAutomovil->idServicio = $request->idServicio;
            $servicioAutomovil->economico = $request->economico;
            $servicioAutomovil->creado_el = date('Y-m-d H:i:s');

            // Si la longitud del económico no es de 5, error
            if(strlen($request->economico) != 5){
                return redirect('/servicios/servicio?id=' . $servicioAutomovil->idServicio . '&alert=' . 1 );
            }
            
            
            $automovil = Automovil::where('automoviles.economico', '=', $servicioAutomovil->economico)->get()[0] ?? [];   
            
            
            

            // Si el económico no ha sido registrado, guardarlo en dicha agencia
            if($automovil === []){                
                $automovil = new Automovil();
                $automovil->economico = $servicioAutomovil->economico;
                $automovil->idAgencia = $request->idAgencia;
                
                $automovil->save();
            }
            // El económico ya fue agregado en el mismo servicio
            else if(ServicioAutomovil::where('servicioautomovil.idServicio', '=', $servicioAutomovil->idServicio)->where('servicioautomovil.economico', '=', $servicioAutomovil->economico)->get()->count()){
                return redirect('/servicios/servicio?id=' . $servicioAutomovil->idServicio . '&alert=' . 2 );
            }

            // Si el económico existe para una agencia diferente, mandar error
            else if($automovil->idAgencia != $request->idAgencia){
                return redirect('/servicios/servicio?id=' . $servicioAutomovil->idServicio . '&alert=' . 0 );
            }

            
            // Añadir el económico a la lista del servicio
            $servicioAutomovil->save();
            return redirect('/servicios/servicio?id=' . $servicioAutomovil->idServicio);
            

        } else if($request->isMethod('get')) {
            
            if(!isset($request->id))     
                return redirect('/servicios');

            $servicio = Servicio::where('servicios.id', '=', $request->id)->join('agencias', 'servicios.idAgencia', '=', 'agencias.id')->get()[0] ?? null;
            $servicio->id = $request->id;

            
            $economicos = ServicioAutomovil::select('economico')->where('servicioautomovil.idServicio', '=', $servicio->id)->join('servicios', 'servicioautomovil.idservicio', '=', 'servicios.id')->orderBy('servicioautomovil.creado_el', 'desc')->get() ?? [];

            return view('/servicios/consultar', [
                'servicio' => $servicio, 
                'economicos' => $economicos,
                'alert' => $request->alert ?? ''
            ]);
        }
    }

    public function eliminar (Request $request) {
        if(!isset($request->id)) 
            return redirect('/servicios');
    
        try {
            ServicioAutomovil::where('idServicio', '=', $request->id)->delete();
            Servicio::find($request->id)->delete();
            return redirect('/servicios');

        } catch (Exception $exc) {
            
        }
    }
}
