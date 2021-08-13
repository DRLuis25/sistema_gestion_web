<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateseguimientoPropuestoRequest;
use App\Http\Requests\UpdateseguimientoPropuestoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\matrizPriorizado;
use App\Models\Process;
use App\Models\Rol;
use App\Models\seguimientoPropuesto;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;
use Exception;
class seguimientoPropuestoController extends AppBaseController
{
    /**
     * Display a listing of the seguimientoPropuesto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var seguimientoPropuesto $seguimientoPropuestos */
            $seguimientoPropuestos = seguimientoPropuesto::all();
            return DataTables::of($seguimientoPropuestos)
            ->addColumn('action','seguimiento_propuestos.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('seguimiento_propuestos.index');
    }

    /**
     * Show the form for creating a new seguimientoPropuesto.
     *
     * @return Response
     */
    public function create()
    {
        return view('seguimiento_propuestos.create');
    }

    /**
     * Store a newly created seguimientoPropuesto in storage.
     *
     * @param CreateseguimientoPropuestoRequest $request
     *
     * @return Response
     */
    public function store(CreateseguimientoPropuestoRequest $request)
    {
        $input = $request->all();

        /** @var seguimientoPropuesto $seguimientoPropuesto */
        $seguimientoPropuesto = seguimientoPropuesto::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/seguimientoPropuestos.singular')]));

        return redirect(route('seguimientoPropuestos.index'));
    }

    /**
     * Display the specified seguimientoPropuesto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2, $id3, Request $request)
    {
        $process = Process::find($id3);
        $procesosPriorizados = matrizPriorizado::where('process_map_id','=',$id2)
        ->first();
        if (empty($procesosPriorizados)) {
            Flash::error("Completar la priorización de procesos críticos");
            return redirect(route('processCriterios.index', [$id, $id2]))
            ->with('company_id',$id)->with('process_map_id',$id2);
        }
        if($request->ajax()){
            /** @var Seguimiento $seguimientos */
            $seguimientos = seguimientoPropuesto::where('process_id','=',$id3)
            ->where('matriz_priorizado_id','=',$procesosPriorizados->id)
            ->get();
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
            ->addColumn('action','seguimiento_propuestos.activity.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        $roles = Rol::where('process_map_id','=',$id2)->get();
        //return $procesosSinSeguimiento;
        return view('seguimiento_propuestos.show',compact('roles','process'))->with('company_id',$id)
        ->with('process_map_id',$id2)
        ->with('process_id',$id3);

    }
    public function getSeguimientoPropuesto($id, $id2, $id3)
    {
        $process = Process::find($id);
        $procesosPriorizados = matrizPriorizado::where('process_map_id','=',$process->process_map_id)->first();
        $actividades = seguimientoPropuesto::where('process_id','=',$id3)->where('matriz_priorizado_id',$procesosPriorizados->id)->get();
        //return $actividades;
        return view('seguimiento_propuestos.view_seguimiento.seguimiento_table',compact('actividades'))->with('company_id',$id)->with('process_map_id',$id2)->with('seguimiento_id',$id3);
    }
    public function storeActivityPropuesto(Request $request)
    {
        try{
            $input = $request->all();
            $procesosPriorizados = matrizPriorizado::where('process_map_id','=',$request->process_map_id)
            ->first();
            $input['matriz_priorizado_id'] = $procesosPriorizados->id;
            $seguimiento = seguimientoPropuesto::create($input);
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            return Response::json(['status'=>'500','e'=> $e->getMessage()], 200);
        }
    }
    public function getTimesPropuesto($id)
    {
        $process = Process::find($id);

        $procesosPriorizados = matrizPriorizado::where('process_map_id','=',$process->process_map_id)->first();
        try{
            $rolTimes = seguimientoPropuesto::where('process_id','=',$id)->where('matriz_priorizado_id',$procesosPriorizados->id)
            ->selectRaw('rol.name as name, sum(time) as total')
            ->join('process','process.id','=','seguimiento_propuesto.process_id')
            ->join('rol','rol.id','=','seguimiento_propuesto.rol_id')
            ->groupBy('rol.name')
            ->get();
            $flowTimes = seguimientoPropuesto::where('process_id','=',$id)->where('matriz_priorizado_id',$procesosPriorizados->id)
            ->selectRaw('seguimiento_propuesto.flow_id, sum(time) as total')
            ->join('process','process.id','=','seguimiento_propuesto.process_id')
            ->join('rol','rol.id','=','seguimiento_propuesto.rol_id')
            ->groupBy('seguimiento_propuesto.flow_id')
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
    /**
     * Show the form for editing the specified seguimientoPropuesto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var seguimientoPropuesto $seguimientoPropuesto */
        $seguimientoPropuesto = seguimientoPropuesto::find($id);

        if (empty($seguimientoPropuesto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientoPropuestos.singular')]));

            return redirect(route('seguimientoPropuestos.index'));
        }

        return view('seguimiento_propuestos.edit')->with('seguimientoPropuesto', $seguimientoPropuesto);
    }

    /**
     * Update the specified seguimientoPropuesto in storage.
     *
     * @param int $id
     * @param UpdateseguimientoPropuestoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateseguimientoPropuestoRequest $request)
    {
        /** @var seguimientoPropuesto $seguimientoPropuesto */
        $seguimientoPropuesto = seguimientoPropuesto::find($id);

        if (empty($seguimientoPropuesto)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientoPropuestos.singular')]));

            return redirect(route('seguimientoPropuestos.index'));
        }

        $seguimientoPropuesto->fill($request->all());
        $seguimientoPropuesto->save();

        Flash::success(__('messages.updated', ['model' => __('models/seguimientoPropuestos.singular')]));

        return redirect(route('seguimientoPropuestos.index'));
    }

    public function destroy($id, $id2, $id3, Request $request)
    {

        $seguimiento = seguimientoPropuesto::where('process_id','=',$id3)->delete();

        if (empty($seguimiento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientos.singular')]));

            return redirect(route('seguimientos.index',[$id, $id2]));
        }
        Flash::success(__('messages.deleted', ['model' => __('models/seguimientos.singular')]));

        return redirect(route('seguimientos.index',[$id, $id2]));
    }
    public function destroySeguimientoActividadPropuesto($id, $id2, $id3, $id4, Request $request)
    {
        /** @var Seguimiento $seguimiento */
        //Eliminar solo un seguimiento del proceso
        $seguimiento = seguimientoPropuesto::find($id4);

        if (empty($seguimiento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/seguimientos.singular')]));

            return redirect(route('seguimientoPropuestos.index',[$id, $id2]));
        }
        $seguimiento->delete();
        //Flash::success(__('messages.deleted', ['model' => __('models/seguimientos.singular')]));

        return redirect(route('seguimientoPropuestos.show',[$id, $id2, $id3]));
    }
}
