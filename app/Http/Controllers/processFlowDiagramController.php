<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprocessFlowDiagramRequest;
use App\Http\Requests\UpdateprocessFlowDiagramRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Criterio;
use App\Models\Process;
use App\Models\processCriterio;
use App\Models\processFlowDiagram;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class processFlowDiagramController extends AppBaseController
{
    /**
     * Display a listing of the processFlowDiagram.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2, Request $request)
    {
        if($request->ajax()){
            /** @var processFlowDiagram $processFlowDiagrams */
            $processFlowDiagrams = processFlowDiagram::where('process_map_id','=',$id2)->get();
            return DataTables::of($processFlowDiagrams)
            ->addColumn('company_id',function($processFlowDiagram){
                return $processFlowDiagram->processMap->company_id;
            })
            ->addColumn('processName',function($processFlowDiagram){
                return $processFlowDiagram->process->name;
            })
            ->addColumn('action','process_flow_diagrams.actions')
            ->addColumn('redesing','process_flow_diagrams.redesing')
            ->rawColumns(['action','redesing'])
            ->make(true);
        }
        $procesosSinFlowDiagram = Process::where('process_map_id','=',$id2)->doesnthave('processFlowDiagrams')->get();
        $criterios = Criterio::where('process_map_id','=',$id2)->get()->count();
        $procesos = Process::where('process_map_id','=',$id2)->whereNull('parent_process_id')->get()->count();
        $matrizPriorizacionCriterios = processCriterio::where('process_map_id','=',$id2)->first();
        $total = (isset($matrizPriorizacionCriterios->data))?count(json_decode($matrizPriorizacionCriterios->data, true)):0;
        if ($criterios*$procesos != $total) {
            Flash::error("Completar la Matriz de Priorización de procesos críticos");
            return redirect(route('processCriterios.index', [$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
        }
        return view('process_flow_diagrams.index',compact('procesosSinFlowDiagram'))->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for creating a new processFlowDiagram.
     *
     * @return Response
     */
    public function create($id, $id2, Request $request)
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
        //Guardar archivo y directo al index
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index',[$id, $id2]));
    }
    public function createApplication($id, $id2, Request $request)
    {
        //return $request;
        //Vista para crear desde aplicación
        $process = Process::where('id','=',$request->process_id)->first();
        //return $process;
        return view('process_flow_diagrams.create',compact('process'))->with('process_id',$request->process_id)->with('company_id',$id)->with('process_map_id',$id2);
    }
    public function createRedesignApplication($id, $id2, $id3, Request $request)
    {
        $processFlowDiagram = processFlowDiagram::find($id3);
        $process= $processFlowDiagram->process;
        return view('process_flow_diagrams.redesign.create',compact('process'))->with('process_flow_diagram_id',$processFlowDiagram->id)->with('process_id',$process->id)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Store a newly created processFlowDiagram in storage.
     *
     * @param CreateprocessFlowDiagramRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, Request $request)
    {

        $input = $request->except('_token');
        $input['adjunto'] = false;
        //return $input;
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index',[$id, $id2]));
    }
    public function storeRedesignFile(Request $request)
    {
        try{
            $processFlowDiagram = processFlowDiagram::find($request->process_id);
            if (empty($processFlowDiagram)) {
                return Response::json(['status'=>'500','e'=> 'No se encontró Diagrama Flujo Proceso'], 200);
            }
            $input = $request->except('_token');
            if ($request->hasFile('fileUpdate')) {
                $input['redesign_file'] = $request->file('fileUpdate')->store('hojasCaracterizacion','public');
            }
            unset($input['fileUpdate']);
            unset($input['process_id']);
            $input['redesing_adjunto'] = true;
            $input['redesing_boolean'] = true;
            $input['process_map_id'] = $request->process_map_id;
            $processFlowDiagram->fill($input);
            $processFlowDiagram->save();
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            return Response::json(['status'=>'500','e'=> $e->getMessage()], 200);
        }
    }
    public function storeRedesignApplication($id, $id2, $id3,Request $request)
    {
        $input = $request->only('data');
        $processFlowDiagram = processFlowDiagram::find($id3);
        if (empty($processFlowDiagram)) {
            Flash::error("No se encontró el Diagrama de Flujo de Proceso");
        }
        $processFlowDiagram->redesing_boolean = true;
        $processFlowDiagram->redesing_adjunto = false;
        $processFlowDiagram->redesign_data = $request->data;
        $processFlowDiagram->save();
        //return $processFlowDiagram;
        Flash::success(__('messages.stored', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index',[$id, $id2]));
    }
    public function updateRedesignApplication($id, $id2, $id3,Request $request)
    {
        //return $request;
        $processFlowDiagram = processFlowDiagram::find($id3);
        if (empty($processFlowDiagram)) {
            Flash::error("No se encontró el Diagrama de Flujo de Proceso");
        }
        $processFlowDiagram->redesing_boolean = true;
        $processFlowDiagram->redesing_adjunto = false;
        $processFlowDiagram->redesign_data = $request->data;
        $processFlowDiagram->save();
        //return $processFlowDiagram;
        Flash::success(__('messages.updated', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index',[$id, $id2]));
    }

    /**
     * Display the specified processFlowDiagram.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2, $id3)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id3);

        if (empty($processFlowDiagram)) {
            Flash::error(__('models/processFlowDiagrams.singular').' '.__('messages.not_found'));

            return redirect(route('processFlowDiagrams.index',[$id, $id2]));
        }

        return view('process_flow_diagrams.show')->with('processFlowDiagram', $processFlowDiagram)->with('company_id',$id)->with('process_map_id',$id2);
    }
    public function showRedesignApplication($id, $id2, $id3)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id3);

        if (empty($processFlowDiagram)) {
            Flash::error(__('models/processFlowDiagrams.singular').' '.__('messages.not_found'));

            return redirect(route('processFlowDiagrams.index',[$id, $id2]));
        }

        return view('process_flow_diagrams.redesign.show')->with('processFlowDiagram', $processFlowDiagram)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for editing the specified processFlowDiagram.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2, $id3)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id3);
        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index',[$id, $id2]));
        }
        $process = Process::where('id','=',$processFlowDiagram->process_id)->first();
        return view('process_flow_diagrams.edit',compact('process'))->with('process_id',$process->id)->with('processFlowDiagram', $processFlowDiagram)->with('company_id',$id)->with('process_map_id',$id2);
    }
    public function editRedesignApplication($id, $id2, $id3)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id3);
        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index',[$id, $id2]));
        }
        $process = Process::where('id','=',$processFlowDiagram->process_id)->first();
        return view('process_flow_diagrams.redesign.edit',compact('process'))->with('process_id',$process->id)->with('processFlowDiagram', $processFlowDiagram)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Update the specified processFlowDiagram in storage.
     *
     * @param int $id
     * @param UpdateprocessFlowDiagramRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, $id3, Request $request)
    {

        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id3);
        //return $request;
        $input['adjunto'] = false;
        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index',[$id, $id2]));
        }

        $processFlowDiagram->fill($request->all());
        $processFlowDiagram->save();

        Flash::success(__('messages.updated', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index',[$id, $id2]));
    }

    /**
     * Remove the specified processFlowDiagram from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2, $id3)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id3);

        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index',[$id, $id2]));
        }

        $processFlowDiagram->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index', [$id, $id2]));
    }
    public function destroyProcessFlowDiagramRedesign($id, $id2, $id3)
    {

        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id3);

        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index',[$id, $id2]));
        }
        $processFlowDiagram->redesing_boolean=null;
        $processFlowDiagram->redesign_data=null;
        $processFlowDiagram->redesign_file=null;
        $processFlowDiagram->redesing_adjunto=null;
        $processFlowDiagram->save();

        Flash::success(__('messages.deleted', ['model' => 'Adjunto']));

        return redirect(route('processFlowDiagrams.index', [$id, $id2]));
    }
}
