<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprocessMapRequest;
use App\Http\Requests\UpdateprocessMapRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\businessUnit;
use App\Models\Company;
use App\Models\processMap;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class processMapController extends AppBaseController
{
    /**
     * Display a listing of the processMap.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
    {
        $company = Company::find($id);
        if($request->ajax()){
            /** @var processMap $processMaps */
            $processMaps = processMap::where('company_id','=',$id)->get();
            return DataTables::of($processMaps)
            ->addColumn('businessUnit',function($supplyChain){
                return $supplyChain->businessUnit->name;
            })
            ->addColumn('action','process_maps.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('process_maps.index',compact('company'))->with('company_id',$id);
    }

    /**
     * Show the form for creating a new processMap.
     *
     * @return Response
     */
    public function create($id)
    {
        $business_units = businessUnit::where('company_id','=',$id)->get();
        return view('process_maps.create',compact('business_units'))->with('company_id',$id);
    }

    /**
     * Store a newly created processMap in storage.
     *
     * @param CreateprocessMapRequest $request
     *
     * @return Response
     */
    public function store(CreateprocessMapRequest $request)
    {
        $input = $request->all();
        /** @var processMap $processMap */
        $processMap = processMap::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/processMaps.singular')]));

        return redirect(route('processMaps.index',[$processMap->company_id]));
    }

    /**
     * Display the specified processMap.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2)
    {

        /** @var processMap $processMap */
        $processMap = processMap::find($id2);

        if (empty($processMap)) {
            Flash::error(__('models/processMaps.singular').' '.__('messages.not_found'));

            return redirect(route('companies.index'));
        }

        return view('process_maps.show',compact('processMap'))->with('processMap', $processMap)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for editing the specified processMap.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2)
    {
        /** @var processMap $processMap */
        $processMap = processMap::find($id2);

        if (empty($processMap)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processMaps.singular')]));

            return redirect(route('companies.index'));
        }

        return view('process_maps.edit')->with('processMap', $processMap)->with('company_id',$processMap->company_id);
    }

    /**
     * Update the specified processMap in storage.
     *
     * @param int $id
     * @param UpdateprocessMapRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, UpdateprocessMapRequest $request)
    {
        /** @var processMap $processMap */
        $processMap = processMap::find($id2);

        if (empty($processMap)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processMaps.singular')]));

            return redirect(route('companies.index'));
        }

        $processMap->fill($request->all());
        $processMap->save();

        Flash::success(__('messages.updated', ['model' => __('models/processMaps.singular')]));

        return redirect(route('processMaps.index',[$id]));
    }

    /**
     * Remove the specified processMap from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        /** @var processMap $processMap */
        $processMap = processMap::find($id2);

        if (empty($processMap)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processMaps.singular')]));

            return redirect(route('companies.index'));
        }

        $processMap->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/processMaps.singular')]));

        return redirect(route('processMaps.index',[$id]));
    }
}
