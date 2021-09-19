<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreatehistorialStrategicMapRequest;
use App\Http\Requests\UpdatehistorialStrategicMapRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\historialStrategicMap;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class historialStrategicMapController extends AppBaseController
{
    public function index($id, $id2, Request $request)
    {
        if($request->ajax()){
            $historialStrategicMaps = historialStrategicMap::where('matriz_priorizado_id',$id)
            ->where('process_id',$id2)->get();
            return DataTables::of($historialStrategicMaps)
            ->addColumn('created',function($historial){
                return date('d-m-Y H:i:s',strtotime($historial->created_at));
            })
            ->addColumn('action','matriz_priorizados.process_priorizados.historial.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store(CreatehistorialStrategicMapRequest $request)
    {
        try{
            $input = $request->all();
            $historialStrategicMap = historialStrategicMap::create($input);
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json(['status'=>'500','message'=>$e->getMessage()], 200);
        }
    }

    public function destroy($id)
    {
        /** @var historialStrategicMap $historialStrategicMap */
        $historialStrategicMap = historialStrategicMap::find($id);

        if (empty($historialStrategicMap)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historialStrategicMaps.singular')]));

            return redirect(route('historialStrategicMaps.index'));
        }

        $historialStrategicMap->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/historialStrategicMaps.singular')]));

        return redirect(route('historialStrategicMaps.index'));
    }
}
