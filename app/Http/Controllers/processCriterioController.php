<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprocessCriterioRequest;
use App\Http\Requests\UpdateprocessCriterioRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Criterio;
use App\Models\Process;
use App\Models\processCriterio;
use App\Models\processMap;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class processCriterioController extends AppBaseController
{
    /**
     * Display a listing of the processCriterio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getMatrizPriorizacion($id, Request $request)
    {
        if($request->ajax()){
            $processCriterio = processCriterio::where('process_map_id','=',$id)->first();
            return response()->json([
                'matriz'=>$processCriterio
            ]);
        }
    }
    public function index($id, $id2, Request $request)
    {
        //if($request->ajax()){
            /** @var processCriterio $processCriterios */
            $procesos = Process::where('process_map_id','=','1')->whereNull('parent_process_id')->get();
            $criterios = Criterio::where('process_map_id','=','1')->get();
            /*return response()->json([
                'procesos'=>$procesos,
                'criterios'=>$criterios
            ]);
        }*/
        return view('process_criterios.index',compact('procesos','criterios'))->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Store a newly created processCriterio in storage.
     *
     * @param CreateprocessCriterioRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, Request $request)
    {
        $input = $request->except('_token');
        $data = json_encode($input);
        $processCriterio = processCriterio::firstOrCreate(['process_map_id' => $id2], ['data' => $data]);
        $processCriterio->data = $data;
        $processCriterio->save();
        $processMap = processMap::where('id','=','1')->first();
        $processMap->status = true;
        Flash::success(__('messages.saved', ['model' => __('models/processCriterios.singular')]));
        return redirect(route('processCriterios.index', [$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
    }

}
