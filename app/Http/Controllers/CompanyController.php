<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\businessUnit;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\supplyChain;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class CompanyController extends AppBaseController
{
    /**
     * Display a listing of the Company.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var Company $companies */
            $companies = Company::all();
            return DataTables::of($companies)
            ->addColumn('action','companies.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('companies.index');
    }

    public function showCompany($id)
    {
        $company = Company::find($id);
        return view('companies.show',compact('company'))->with('company_id',$company->id);
    }

    public function showSuppliers($id,Request $request)
    {
        $company = Company::find($id);
        if($request->ajax()){
            /** @var Supplier $suppliers */
            $suppliers = Supplier::where('company_id','=',$company->id)->get();
            return DataTables::of($suppliers)
            ->addColumn('action','suppliers.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('suppliers.index')->with('company_id',$company->id);;
    }

    public function showCustomers($id,Request $request)
    {
        $company = Company::find($id);
        if($request->ajax()){
            /** @var Customer $customers */
            $customers = Customer::where('company_id','=',$company->id)->get();
            return DataTables::of($customers)
            ->addColumn('action','customers.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('customers.index',compact('company'))->with('company_id',$company->id);
    }

    public function showBusinessUnits($id,Request $request)
    {
        $company = Company::find($id);
        if($request->ajax()){
            /** @var businessUnit $businessUnits */
            $businessUnits = businessUnit::where('company_id','=',$company->id)->get();
            return DataTables::of($businessUnits)
            ->addColumn('action','business_units.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('business_units.index',compact('company'))->with('company_id',$company->id);
    }

    public function showSupplyChains($id, Request $request)
    {
        $company = Company::find($id);
        if($request->ajax()){
            /** @var supplyChain $supplyChains */
            $supplyChains = supplyChain::where('company_id','=',$company->id)->get();
            return DataTables::of($supplyChains)
            ->addColumn('action','supply_chains.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('supply_chains.index',compact('company'))->with('company_id',$company->id);
    }

    /**
     * Show the form for creating a new Company.
     *
     * @return Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created Company in storage.
     *
     * @param CreateCompanyRequest $request
     *
     * @return Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $input = $request->all();

        /** @var Company $company */
        $company = Company::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/companies.singular')]));

        return redirect(route('companies.index'));
    }

    /**
     * Display the specified Company.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Company $company */
        $company = Company::find($id);

        if (empty($company)) {
            Flash::error(__('models/companies.singular').' '.__('messages.not_found'));

            return redirect(route('companies.index'));
        }

        return view('companies.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified Company.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Company $company */
        $company = Company::find($id);

        if (empty($company)) {
            Flash::error(__('messages.not_found', ['model' => __('models/companies.singular')]));

            return redirect(route('companies.index'));
        }

        return view('companies.edit')->with('company', $company);
    }

    /**
     * Update the specified Company in storage.
     *
     * @param int $id
     * @param UpdateCompanyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompanyRequest $request)
    {
        /** @var Company $company */
        $company = Company::find($id);

        if (empty($company)) {
            Flash::error(__('messages.not_found', ['model' => __('models/companies.singular')]));

            return redirect(route('companies.index'));
        }

        $company->fill($request->all());
        $company->save();

        Flash::success(__('messages.updated', ['model' => __('models/companies.singular')]));

        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Company $company */
        $company = Company::find($id);

        if (empty($company)) {
            Flash::error(__('messages.not_found', ['model' => __('models/companies.singular')]));

            return redirect(route('companies.index'));
        }

        $company->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/companies.singular')]));

        return redirect(route('companies.index'));
    }
}
