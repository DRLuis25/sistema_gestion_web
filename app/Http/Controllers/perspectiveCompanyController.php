<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateperspectiveCompanyRequest;
use App\Http\Requests\UpdateperspectiveCompanyRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\perspectiveCompany;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class perspectiveCompanyController extends AppBaseController
{
    /**
     * Display a listing of the perspectiveCompany.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
    {
        if($request->ajax()){
            /** @var perspectiveCompany $perspectiveCompanies */
            $perspectiveCompanies = perspectiveCompany::all();
            return DataTables::of($perspectiveCompanies)
            ->addColumn('action','perspective_companies.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('perspective_companies.index')
        ->with('company_id',$id);
    }

    /**
     * Show the form for creating a new perspectiveCompany.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('perspective_companies.create')->with('company_id',$id);
    }

    /**
     * Store a newly created perspectiveCompany in storage.
     *
     * @param CreateperspectiveCompanyRequest $request
     *
     * @return Response
     */
    public function store($id, CreateperspectiveCompanyRequest $request)
    {
        $input = $request->all();

        /** @var perspectiveCompany $perspectiveCompany */
        $perspectiveCompany = perspectiveCompany::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/perspectiveCompanies.singular')]));

        return redirect(route('perspectiveCompanies.index',[$id]));
    }

    /**
     * Display the specified perspectiveCompany.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2)
    {
        /** @var perspectiveCompany $perspectiveCompany */
        $perspectiveCompany = perspectiveCompany::find($id2);

        if (empty($perspectiveCompany)) {
            Flash::error(__('models/perspectiveCompanies.singular').' '.__('messages.not_found'));

            return redirect(route('perspectiveCompanies.index',[$id]));
        }

        return view('perspective_companies.show')->with('perspectiveCompany', $perspectiveCompany)->with('company_id',$id);
    }

    /**
     * Show the form for editing the specified perspectiveCompany.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2)
    {
        /** @var perspectiveCompany $perspectiveCompany */
        $perspectiveCompany = perspectiveCompany::find($id2);

        if (empty($perspectiveCompany)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectiveCompanies.singular')]));

            return redirect(route('perspectiveCompanies.index',[$id]));
        }

        return view('perspective_companies.edit')->with('perspectiveCompany', $perspectiveCompany)->with('company_id',$id);
    }

    /**
     * Update the specified perspectiveCompany in storage.
     *
     * @param int $id
     * @param UpdateperspectiveCompanyRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, UpdateperspectiveCompanyRequest $request)
    {
        /** @var perspectiveCompany $perspectiveCompany */
        $perspectiveCompany = perspectiveCompany::find($id2);

        if (empty($perspectiveCompany)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectiveCompanies.singular')]));

            return redirect(route('perspectiveCompanies.index',[$id]));
        }

        $perspectiveCompany->fill($request->all());
        $perspectiveCompany->save();

        Flash::success(__('messages.updated', ['model' => __('models/perspectiveCompanies.singular')]));

        return redirect(route('perspectiveCompanies.index',[$id]));
    }

    /**
     * Remove the specified perspectiveCompany from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        /** @var perspectiveCompany $perspectiveCompany */
        $perspectiveCompany = perspectiveCompany::find($id2);

        if (empty($perspectiveCompany)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectiveCompanies.singular')]));

            return redirect(route('perspectiveCompanies.index',[$id]));
        }

        $perspectiveCompany->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/perspectiveCompanies.singular')]));

        return redirect(route('perspectiveCompanies.index',[$id]));
    }
}
