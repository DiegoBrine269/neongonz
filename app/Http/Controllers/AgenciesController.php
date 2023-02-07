<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\ServicioAutomovil;
use App\Models\Servicio;
use App\Models\Automovil;

class AgenciesController extends Controller
{
    public function index ($alert = '') {


        $agencias = Agencia::all();

        return view('/agencias/index', [
            'agencias' => $agencias, 
            'alert' => $alert
        ]);
    }

    public function nueva (Request $request) {
        if($request->isMethod('post')) { 
            try {
                $agencia = new Agencia();
                $agencia->nombre = $request->nombre;
                $agencia->responsable = $request->responsable;
                $agencia->save();
            } catch (Exception $ex) {
                return $this->index('0');
            }

            return $this->index('1');
            
        } else if($request->isMethod('get')) {
            return view('/agencias/nueva');
        }
    }

    public function editar (Request $request) {
        if($request->isMethod('post')) { 
            try {
                Agencia::where('id', $request->id)->update(['nombre' => $request->nombre,
                                                            'responsable' => $request->responsable
                                                        ]);
            } catch (Exception $ex) {
                return $this->index('0');
            }

            return $this->index('2');
            
        } else if($request->isMethod('get')) {
            if(!isset($request->id)) 
                return redirect('/agencias');

            $agencia = Agencia::find($request->id);

            return view('/agencias/editar', [
                'agencia' => $agencia
            ]);
        }
    }


    public function eliminar (Request $request) {
        if(!isset($request->id)) 
            return redirect('/agencias');
    
        try {

            $servicios = Servicio::where('idAgencia', '=', $request->id)->get();
            
            //Eliminando todos los servicios relacionados a la agencia
            if($servicios->count() > 0) {
                foreach ($servicios as $servicio) {
                    
                    ServicioAutomovil::where('idServicio', '=', $servicio->id)->delete();
                }
                
                Servicio::where('idAgencia', '=', $request->id)->delete();
            }

            Automovil::where('idAgencia', '=', $request->id)->delete();
            Agencia::where('id', '=', $request->id)->delete();

            return $this->index('3');

        } catch (Exception $exc) {
            
        }
    }
}
