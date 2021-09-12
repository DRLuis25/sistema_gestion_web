<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateobjectiveCompanyRequest;
use App\Http\Requests\UpdateobjectiveCompanyRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\objectiveCompany;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class objectiveCompanyController extends AppBaseController
{
    /**
     * Display a listing of the objectiveCompany.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
    {
        if($request->ajax()){
            /** @var objectiveCompany $objectiveCompanies */
            $objectiveCompanies = objectiveCompany::all();
            return DataTables::of($objectiveCompanies)
            ->addColumn('action','objective_companies.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('objective_companies.index')->with('company_id',$id);
    }

    /**
     * Show the form for creating a new objectiveCompany.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('objective_companies.create')->with('company_id',$id);
    }

    /**
     * Store a newly created objectiveCompany in storage.
     *
     * @param CreateobjectiveCompanyRequest $request
     *
     * @return Response
     */
    public function store($id, CreateobjectiveCompanyRequest $request)
    {
        $input = $request->all();

        /** @var objectiveCompany $objectiveCompany */
        $objectiveCompany = objectiveCompany::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/objectiveCompanies.singular')]));

        return redirect(route('objectiveCompanies.index',[$id]));
    }

    /**
     * Display the specified objectiveCompany.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2)
    {
        /** @var objectiveCompany $objectiveCompany */
        $objectiveCompany = objectiveCompany::find($id2);

        if (empty($objectiveCompany)) {
            Flash::error(__('models/objectiveCompanies.singular').' '.__('messages.not_found'));

            return redirect(route('objectiveCompanies.index',[$id]));
        }

        return view('objective_companies.show')->with('objectiveCompany', $objectiveCompany)->with('company_id',$id);
    }

    /**
     * Show the form for editing the specified objectiveCompany.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2)
    {
        /** @var objectiveCompany $objectiveCompany */
        $objectiveCompany = objectiveCompany::find($id2);

        if (empty($objectiveCompany)) {
            Flash::error(__('messages.not_found', ['model' => __('models/objectiveCompanies.singular')]));

            return redirect(route('objectiveCompanies.index',[$id]));
        }

        return view('objective_companies.edit')->with('objectiveCompany', $objectiveCompany)->with('company_id',$id);
    }

    /**
     * Update the specified objectiveCompany in storage.
     *
     * @param int $id
     * @param UpdateobjectiveCompanyRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, UpdateobjectiveCompanyRequest $request)
    {
        /** @var objectiveCompany $objectiveCompany */
        $objectiveCompany = objectiveCompany::find($id2);

        if (empty($objectiveCompany)) {
            Flash::error(__('messages.not_found', ['model' => __('models/objectiveCompanies.singular')]));

            return redirect(route('objectiveCompanies.index',[$id]));
        }

        $objectiveCompany->fill($request->all());
        $objectiveCompany->save();

        Flash::success(__('messages.updated', ['model' => __('models/objectiveCompanies.singular')]));

        return redirect(route('objectiveCompanies.index',[$id]));
    }

    /**
     * Remove the specified objectiveCompany from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        /** @var objectiveCompany $objectiveCompany */
        $objectiveCompany = objectiveCompany::find($id2);

        if (empty($objectiveCompany)) {
            Flash::error(__('messages.not_found', ['model' => __('models/objectiveCompanies.singular')]));

            return redirect(route('objectiveCompanies.index',[$id]));
        }

        $objectiveCompany->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/objectiveCompanies.singular')]));

        return redirect(route('objectiveCompanies.index',[$id]));
    }
}
