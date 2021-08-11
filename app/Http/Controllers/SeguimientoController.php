<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeguimientoRequest;
use App\Http\Requests\UpdateSeguimientoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Criterio;
use App\Models\matrizPriorizado;
use App\Models\Process;
use App\Models\processCriterio;
use App\Models\Rol;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;
use Exception;
class SeguimientoController extends AppBaseController
{
    /**
     * Display a listing of the Seguimiento.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2, Request $request)
    {
        if($request->ajax()){
            $seguimientos = Process::where('process_map_id','=',$id2)->has('seguimientos')->get();
            return DataTables::of($seguimientos)
            ->addColumn('company_id',function($seguimiento){
                return $seguimiento->processMap->company_id;
            })
            ->addColumn('propuestos',function($seguimiento){
                return $seguimiento->seguimientoPropuestos->count();
            })
            ->addColumn('action','seguimientos.actions')
            ->addColumn('actionPropuesto','seguimiento_propuestos.actions')
            ->rawColumns(['action','actionPropuesto'])
            ->make(true);
        }
        $procesosPriorizados = matrizPriorizado::where('process_map_id','=',$id2)->first();
        $ids = json_decode($procesosPriorizados->process_id_data);
        //$procesosSinHojaCaracterizacion = Process::find($ids);
        $procesosSinSeguimiento = Process::whereIn('id', $ids)->doesnthave('seguimientos')->whereNull('parent_process_id')->get();
        /*$procesosSinSeguimiento = Process::where('process_map_id','=',$id2)->doesnthave('seguimientos')->get();*/
        $criterios = Criterio::where('process_map_id','=',$id2)->get()->count();
        $procesos = Process::where('process_map_id','=',$id2)->whereNull('parent_process_id')->get()->count();
        $matrizPriorizacionCriterios = processCriterio::where('process_map_id','=',$id2)->first();
        $total = (isset($matrizPriorizacionCriterios->data))?count(json_decode($matrizPriorizacionCriterios->data, true)):0;
        if ($criterios*$procesos != $total) {
            Flash::error("Completar la Matriz de Priorización de procesos críticos");
            return redirect(route('processCriterios.index', [$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
        }
        return view('seguimientos.index',compact('procesosSinSeguimiento'))->with('company_id',$id)->with('process_map_id',$id2);
    }
    public function create($id, $id2, Request $request)
    {
        $proceso_id = $request->proceso_id;
        return redirect(route('seguimientos.show',[$id,$id2,$proceso_id]))->with('proceso_id',$proceso_id);
    }
    public function show($id, $id2, $id3, Request $request)
    {
        if($request->ajax()){
            /** @var Seguimiento $seguimientos */
            $seguimientos = Seguimiento::where('process_id','=',$id3)->get();
            return DataTables::of($seguimientos)
            ->addColumn('company_id',function($seguimiento){
                return $seguimiento->process->processMap->company_id;
            })
            ->addColumn('process_map_id',function($seguimiento){
                return $seguimiento->process->processMap->id;
            })
            ->addColumn('process_id',function($seguimiento){
                return $seguimiento->process->id;
            })
            ->addColumn('rolname',function($seguimiento){
                return $seguimiento->rol->name;
            })
            ->addColumn('flujoname',function($seguimiento){
                switch ($seguimiento->flow_id) {
                    case '1':
                        return "Operación";
                        break;
                    case '2':
                        return "Transporte";
                        break;
                    case '3':
                        return "Inspección";
                        break;
                    case '4':
                        return "Demora";
                        break;
                    default:
                        return "Almacenaje";
                        break;
                }
            })
            ->addColumn('action','seguimientos.activity.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        $roles = Rol::where('process_map_id','=',$id2)->get();
        //return $procesosSinSeguimiento;
        return view('seguimientos.show',compact('roles'))->with('company_id',$id)
        ->with('process_map_id',$id2)
        ->with('process_id',$id3);
    }
    public function getSeguimiento($id, $id2, $id3)
    {
        $actividades = Seguimiento::where('process_id','=',$id3)->get();
        //return $actividades;
        return view('seguimientos.view_seguimiento.seguimiento_table',compact('actividades'))->with('company_id',$id)->with('process_map_id',$id2)->with('seguimiento_id',$id3);
    }

    public function storeActivity(CreateSeguimientoRequest $request)
    {
        try{
            $input = $request->all();
            $seguimiento = Seguimiento::create($input);
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            return Response::json(['status'=>'500','e'=> $e->getMessage()], 200);
        }
    }
    public function getTimes($id)
    {
        try{
            $rolTimes = Seguimiento::where('process_id','=',$id)
            ->selectRaw('rol.name as name, sum(time) as total')
            ->join('process','process.id','=','seguimiento.process_id')
            ->join('rol','rol.id','=','seguimiento.rol_id')
            ->groupBy('rol.name')
            ->get();
            $flowTimes = Seguimiento::where('process_id','=',$id)
            ->selectRaw('seguimiento.flow_id, sum(time) as total')
            ->join('process','process.id','=','seguimiento.process_id')
            ->join('rol','rol.id','=','seguimiento.rol_id')
            ->groupBy('seguimiento.flow_id')
            ->get();
            return response()->json([
                'status'=>'200',
                'rolTimes'=>$rolTimes,
                'flowTimes'=>$flowTimes
            ],200);
        }
        catch(Exception $e){
            return Response::json(['status'=>'500','e'=> $e->getMessage()], 200);
        }
    }
    public function edit($id)
    {
        /** @var Seguimiento $seguimiento */
        $seguimiento = Seguimiento::find($id);

        if (empty($seguimiento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientos.singular')]));

            return redirect(route('seguimientos.index'));
        }

        return view('seguimientos.edit')->with('seguimiento', $seguimiento);
    }

    /**
     * Update the specified Seguimiento in storage.
     *
     * @param int $id
     * @param UpdateSeguimientoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeguimientoRequest $request)
    {
        /** @var Seguimiento $seguimiento */
        $seguimiento = Seguimiento::find($id);

        if (empty($seguimiento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientos.singular')]));

            return redirect(route('seguimientos.index'));
        }

        $seguimiento->fill($request->all());
        $seguimiento->save();

        Flash::success(__('messages.updated', ['model' => __('models/seguimientos.singular')]));

        return redirect(route('seguimientos.index'));
    }

    /**
     * Remove the specified Seguimiento from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2, $id3, Request $request)
    {
        /** @var Seguimiento $seguimiento */
        //Eliminar todos los seguimientos del proceso
        //return $id3;
        $proceso = Process::where('id','=',$id3)->get();
        //return $proceso;
        $seguimiento = Seguimiento::where('process_id','=',$id3)->delete();

        if (empty($seguimiento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientos.singular')]));

            return redirect(route('seguimientos.index',[$id, $id2]));
        }
        Flash::success(__('messages.deleted', ['model' => __('models/seguimientos.singular')]));

        return redirect(route('seguimientos.index',[$id, $id2]));
    }
    public function destroySeguimientoActividad($id, $id2, $id3, $id4, Request $request)
    {
        /** @var Seguimiento $seguimiento */
        //Eliminar solo un seguimiento del proceso
        $seguimiento = Seguimiento::find($id4);

        if (empty($seguimiento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientos.singular')]));

            return redirect(route('seguimientos.index',[$id, $id2]));
        }
        $seguimiento->delete();
        //Flash::success(__('messages.deleted', ['model' => __('models/seguimientos.singular')]));

        return redirect(route('seguimientos.show',[$id, $id2, $id3]));
    }
}
