<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebusinessUnitRequest;
use App\Http\Requests\UpdatebusinessUnitRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\businessUnit;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class businessUnitController extends AppBaseController
{
    /**
     * Display a listing of the businessUnit.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
    {
        if($request->ajax()){
            /** @var businessUnit $businessUnits */
            $businessUnits = businessUnit::where('company_id','=',$id)->get();
            return DataTables::of($businessUnits)
            ->addColumn('action','business_units.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('business_units.index')->with('company_id',$id);
    }

    /**
     * Show the form for creating a new businessUnit.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('business_units.create')->with('company_id',$id);
    }

    /**
     * Store a newly created businessUnit in storage.
     *
     * @param CreatebusinessUnitRequest $request
     *
     * @return Response
     */
    public function store(CreatebusinessUnitRequest $request)
    {
        $input = $request->all();

        /** @var businessUnit $businessUnit */
        $businessUnit = businessUnit::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/businessUnits.singular')]));

        return redirect(route('businessUnits.index',[$businessUnit->company_id]));
    }

    /**
     * Display the specified businessUnit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id,$id2)
    {
        /** @var businessUnit $businessUnit */
        $businessUnit = businessUnit::find($id2);

        if (empty($businessUnit)) {
            Flash::error(__('models/businessUnits.singular').' '.__('messages.not_found'));

            return redirect(route('companies.index'));
        }

        return view('business_units.show')->with('businessUnit', $businessUnit)->with('company_id',$businessUnit->company_id);;
    }

    /**
     * Show the form for editing the specified businessUnit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2)
    {
        /** @var businessUnit $businessUnit */
        $businessUnit = businessUnit::find($id2);

        if (empty($businessUnit)) {
            Flash::error(__('messages.not_found', ['model' => __('models/businessUnits.singular')]));

            return redirect(route('companies.index'));
        }

        return view('business_units.edit')->with('businessUnit', $businessUnit)->with('company_id',$businessUnit->company_id);
    }

    /**
     * Update the specified businessUnit in storage.
     *
     * @param int $id
     * @param UpdatebusinessUnitRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, UpdatebusinessUnitRequest $request)
    {
        /** @var businessUnit $businessUnit */
        $businessUnit = businessUnit::find($id2);

        if (empty($businessUnit)) {
            Flash::error(__('messages.not_found', ['model' => __('models/businessUnits.singular')]));

            return redirect(route('companies.index',[$id]));
        }

        $businessUnit->fill($request->all());
        $businessUnit->save();

        Flash::success(__('messages.updated', ['model' => __('models/businessUnits.singular')]));

        return redirect(route('businessUnits.index',[$id]));
    }

    /**
     * Remove the specified businessUnit from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        /** @var businessUnit $businessUnit */
        $businessUnit = businessUnit::find($id2);

        if (empty($businessUnit)) {
            Flash::error(__('messages.not_found', ['model' => __('models/businessUnits.singular')]));

            return redirect(route('companies.index'));
        }

        $businessUnit->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/businessUnits.singular')]));

        return redirect(route('businessUnits.index',[$businessUnit->company_id]));
    }
}
