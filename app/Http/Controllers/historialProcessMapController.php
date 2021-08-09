<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatehistorialProcessMapRequest;
use App\Http\Requests\UpdatehistorialProcessMapRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\historialProcessMap;
use App\Models\processMap;
use App\Models\supplyChain;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class historialProcessMapController extends AppBaseController
{
    /**
     * Display a listing of the historialProcessMap.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var historialProcessMap $historialProcessMaps */
            $historialProcessMaps = historialProcessMap::all();
            return DataTables::of($historialProcessMaps)
            ->addColumn('created',function($historial){
                return date('d-m-Y H:i:s',strtotime($historial->created_at));
            })
            ->addColumn('action','historial_process_maps.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('historial_process_maps.index');
    }
    public function getHistorialProcessMaps($id, Request $request)
    {
        if($request->ajax()){
            /** @var historial $historials */
            $historials = historialProcessMap::where('process_map_id','=',$id)->get();
            return DataTables::of($historials)
            ->addColumn('action','historial_process_maps.actions')
            ->addColumn('created',function($historial){
                return date('d-m-Y H:i:s',strtotime($historial->created_at));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    /**
     * Show the form for creating a new historialProcessMap.
     *
     * @return Response
     */
    public function create()
    {
        return view('historial_process_maps.create');
    }

    /**
     * Store a newly created historialProcessMap in storage.
     *
     * @param CreatehistorialProcessMapRequest $request
     *
     * @return Response
     */
    public function store(CreatehistorialProcessMapRequest $request)
    {
        try{
            $input = $request->all();
            $historialProcessMap = historialProcessMap::create($input);
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json(['status'=>'500','message'=>$e->getMessage()], 200);
        }
    }

    /**
     * Display the specified historialProcessMap.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var historialProcessMap $historialProcessMap */
        $historialProcessMap = historialProcessMap::find($id);

        if (empty($historialProcessMap)) {
            Flash::error(__('models/historialProcessMaps.singular').' '.__('messages.not_found'));

            return redirect(route('historialProcessMaps.index'));
        }

        return view('historial_process_maps.show')->with('historialProcessMap', $historialProcessMap);
    }

    /**
     * Show the form for editing the specified historialProcessMap.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var historialProcessMap $historialProcessMap */
        $historialProcessMap = historialProcessMap::find($id);

        if (empty($historialProcessMap)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historialProcessMaps.singular')]));

            return redirect(route('historialProcessMaps.index'));
        }

        return view('historial_process_maps.edit')->with('historialProcessMap', $historialProcessMap);
    }

    /**
     * Update the specified historialProcessMap in storage.
     *
     * @param int $id
     * @param UpdatehistorialProcessMapRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatehistorialProcessMapRequest $request)
    {
        /** @var historialProcessMap $historialProcessMap */
        $historialProcessMap = historialProcessMap::find($id);

        if (empty($historialProcessMap)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historialProcessMaps.singular')]));

            return redirect(route('historialProcessMaps.index'));
        }

        $historialProcessMap->fill($request->all());
        $historialProcessMap->save();

        Flash::success(__('messages.updated', ['model' => __('models/historialProcessMaps.singular')]));

        return redirect(route('historialProcessMaps.index'));
    }

    /**
     * Remove the specified historialProcessMap from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var historialProcessMap $historialProcessMap */
        $historialProcessMap = historialProcessMap::find($id);
        $processMap = processMap::find($historialProcessMap->processMap->id);
        if (empty($historialProcessMap)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historialProcessMaps.singular')]));

            return redirect()->route('companies.index');
        }
        $historialProcessMap->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/historialProcessMaps.singular')]));

        return redirect()->route('processMaps.show',[$processMap->company_id, $processMap->id]);
    }
}
