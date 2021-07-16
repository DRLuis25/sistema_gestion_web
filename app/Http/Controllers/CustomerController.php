<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\supplyChainCustomer;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class CustomerController extends AppBaseController
{
    /**
     * Display a listing of the Customer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
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

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('customers.create')->with('company_id',$id);
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param CreateCustomerRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $input = $request->all();

        /** @var Customer $customer */
        $customer = Customer::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/customers.singular')]));

        return redirect(route('customers.index',[$customer->company_id]));
    }

    /**
     * Display the specified Customer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id,$id2)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id2);

        if (empty($customer)) {
            Flash::error(__('models/customers.singular').' '.__('messages.not_found'));

            return redirect(route('companies.index',[$id]));
        }

        return view('customers.show')->with('customer', $customer)->with('company_id',$customer->id);
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id2);

        if (empty($customer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/customers.singular')]));

            return redirect(route('companies.index'));
        }

        return view('customers.edit')->with('customer', $customer)->with('company_id',$customer->company_id);
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param int $id
     * @param UpdateCustomerRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, UpdateCustomerRequest $request)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id2);

        if (empty($customer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/customers.singular')]));

            return redirect(route('companies.index'));
        }

        $customer->fill($request->all());
        $customer->save();

        Flash::success(__('messages.updated', ['model' => __('models/customers.singular')]));

        return redirect(route('customers.index',[$customer->company_id]));
    }

    /**
     * Remove the specified Customer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id2);
        $supplyChain = supplyChainCustomer::where('customer_id','=',$customer->id)->get();

        if (count($supplyChain)>0)
        {
            Flash::error('El recurso no se puede eliminar debido a la existencia de recursos relacionados.');
            return redirect(route('customers.index',[$customer->company_id]));
        }
        if (empty($customer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/customers.singular')]));

            return redirect(route('companies.index'));
        }

        $customer->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/customers.singular')]));

        return redirect(route('customers.index',[$customer->company_id]));

    }
    public function getCustomers($id,Request $request)
    {
        if($request->ajax()){
            $customers = Customer::where('company_id','=',$id)->get();
            return response()->json($customers);
        }
    }
}
