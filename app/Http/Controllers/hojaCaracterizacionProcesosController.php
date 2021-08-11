<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatehojaCaracterizacionProcesosRequest;
use App\Http\Requests\UpdatehojaCaracterizacionProcesosRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Criterio;
use App\Models\hojaCaracterizacionProcesos;
use App\Models\matrizPriorizado;
use App\Models\Process;
use App\Models\processCriterio;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

use function GuzzleHttp\json_decode;

class hojaCaracterizacionProcesosController extends AppBaseController
{
    /**
     * Display a listing of the hojaCaracterizacionProcesos.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2, Request $request)
    {
        if($request->ajax()){
            /** @var hojaCaracterizacionProcesos $hojaCaracterizacionProcesos */
            $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::where('process_map_id','=',$id2)->get();
            return DataTables::of($hojaCaracterizacionProcesos)
            ->addColumn('company_id',function($hojaCaracterizacionProcesos){
                return $hojaCaracterizacionProcesos->processMap->company->id;
            })
            ->addColumn('processName',function($hojaCaracterizacionProcesos){
                return $hojaCaracterizacionProcesos->process->name;
            })
            ->addColumn('action','hoja_caracterizacion_procesos.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        $procesosPriorizados = matrizPriorizado::where('process_map_id','=',$id2)->first();
        $ids = json_decode($procesosPriorizados->process_id_data);
        //$procesosSinHojaCaracterizacion = Process::find($ids);
        $procesosSinHojaCaracterizacion = Process::whereIn('id', $ids)->doesnthave('hojaCaracterizacionProcesos')->whereNull('parent_process_id')->get();
        //return $procesosSinHojaCaracterizacion;
        /*$procesosSinHojaCaracterizacion = Process::where('process_map_id','=',$id2)->doesnthave('hojaCaracterizacionProcesos')
        ->whereNull('parent_process_id')->get();*/
        $criterios = Criterio::where('process_map_id','=',$id2)->get()->count();
        $procesos = Process::where('process_map_id','=',$id2)->whereNull('parent_process_id')->get()->count();
        $matrizPriorizacionCriterios = processCriterio::where('process_map_id','=',$id2)->first();
        $total = (isset($matrizPriorizacionCriterios->data))?count(json_decode($matrizPriorizacionCriterios->data, true)):0;
        if ($criterios*$procesos != $total) {
            Flash::error("Completar la Matriz de Priorización de procesos críticos");
            return redirect(route('processCriterios.index', [$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
        }
        return view('hoja_caracterizacion_procesos.index',compact('procesosSinHojaCaracterizacion'))->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for creating a new hojaCaracterizacionProcesos.
     *
     * @return Response
     */
    public function create($id, $id2,Request $request)
    {
        $input = $request->except('_token');
        if ($request->hasFile('file')) {
            $input['data'] = $request->file('file')->store('hojasCaracterizacion','public');
        }
        unset($input['file']);
        $input['adjunto'] = true;
        $input['process_map_id'] = $id2;
        $input['process_id'] = $input['proceso_id'];
        unset($input['proceso_id']);
        //return $input;
        //Guardar archivo
        $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::create($input);
        Flash::success(__('messages.saved', ['model' => __('models/hojaCaracterizacionProcesos.singular')]));
        return redirect(route('hojaCaracterizacionProcesos.index',[$id,$id2]));
    }
    public function createApplication($id, $id2, Request $request)
    {
        //Vista para crear desde aplicación
        $process = Process::where('id','=',$request->process_id)->first();
        //return $process;
        return view('hoja_caracterizacion_procesos.create',compact('process'))->with('process_id',$request->process_id)->with('company_id',$id)->with('process_map_id',$id2);
    }
    /**
     * Store a newly created hojaCaracterizacionProcesos in storage.
     *
     * @param CreatehojaCaracterizacionProcesosRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, Request $request)
    {
        $input = $request->except('_token');
        $input['adjunto'] = false;
        //$input['inspecciones_data'] = json_encode($input['inspecciones_data']);
        //return $input;
        //$input['registros_data'] = json_encode($input['registros_data']);
        //return $input;
        /** @var hojaCaracterizacionProcesos $hojaCaracterizacionProcesos */
        $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::create($input);
        //return $hojaCaracterizacionProcesos;
        Flash::success(__('messages.saved', ['model' => __('models/hojaCaracterizacionProcesos.singular')]));
        return redirect(route('hojaCaracterizacionProcesos.index',[$id,$id2]));
    }


    /**
     * Display the specified hojaCaracterizacionProcesos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2, $id3)
    {
        /** @var hojaCaracterizacionProcesos $hojaCaracterizacionProcesos */
        $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::find($id3);

        if (empty($hojaCaracterizacionProcesos)) {
            Flash::error(__('models/hojaCaracterizacionProcesos.singular').' '.__('messages.not_found'));

            return redirect(route('hojaCaracterizacionProcesos.index',[$id,$id2]));
        }

        return view('hoja_caracterizacion_procesos.show')->with('hojaCaracterizacionProcesos', $hojaCaracterizacionProcesos)->with('process_id',$id3)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for editing the specified hojaCaracterizacionProcesos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2, $id3)
    {
        /** @var hojaCaracterizacionProcesos $hojaCaracterizacionProcesos */
        $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::find($id3);

        if (empty($hojaCaracterizacionProcesos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/hojaCaracterizacionProcesos.singular')]));

            return redirect(route('hojaCaracterizacionProcesos.index'));
        }
        $process = Process::where('id','=',$hojaCaracterizacionProcesos->process_id)->first();
        return view('hoja_caracterizacion_procesos.edit',compact('process'))->with('hojaCaracterizacionProcesos', $hojaCaracterizacionProcesos)->with('process_id',$id3)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Update the specified hojaCaracterizacionProcesos in storage.
     *
     * @param int $id
     * @param UpdatehojaCaracterizacionProcesosRequest $request
     *
     * @return Response
     */
    public function updateFile(Request $request)
    {
        try{
            $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::find($request->process_id);
            if (empty($hojaCaracterizacionProcesos)) {
                return Response::json(['status'=>'500','e'=> 'No se encontró hojaCaracteriaciónProcesos'], 200);
            }
            $input = $request->except('_token');
            if ($request->hasFile('fileUpdate')) {
                $input['data'] = $request->file('fileUpdate')->store('hojasCaracterizacion','public');
            }
            unset($input['fileUpdate']);
            unset($input['process_id']);
            $input['adjunto'] = true;
            $input['process_map_id'] = $request->process_map_id;
            $hojaCaracterizacionProcesos->fill($input);
            $hojaCaracterizacionProcesos->save();
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            return Response::json(['status'=>'500','e'=> $e->getMessage()], 200);
        }
    }
    public function update($id, $id2, $id3, Request $request)
    {
        /** @var hojaCaracterizacionProcesos $hojaCaracterizacionProcesos */
        $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::find($id3);

        if (empty($hojaCaracterizacionProcesos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/hojaCaracterizacionProcesos.singular')]));

            return redirect(route('hojaCaracterizacionProcesos.index',[$id, $id2]));
        }

        $hojaCaracterizacionProcesos->fill($request->all());
        $hojaCaracterizacionProcesos->save();

        Flash::success(__('messages.updated', ['model' => __('models/hojaCaracterizacionProcesos.singular')]));

        return redirect(route('hojaCaracterizacionProcesos.index',[$id, $id2]));
    }

    /**
     * Remove the specified hojaCaracterizacionProcesos from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2, $id3)
    {
        /** @var hojaCaracterizacionProcesos $hojaCaracterizacionProcesos */
        $hojaCaracterizacionProcesos = hojaCaracterizacionProcesos::find($id3);

        if (empty($hojaCaracterizacionProcesos)) {
            Flash::error(__('messages.not_found', ['model' => __('models/hojaCaracterizacionProcesos.singular')]));

            return redirect(route('hojaCaracterizacionProcesos.index',[$id,$id2]));
        }

        $hojaCaracterizacionProcesos->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/hojaCaracterizacionProcesos.singular')]));

        return redirect(route('hojaCaracterizacionProcesos.index',[$id,$id2]));
    }
}
