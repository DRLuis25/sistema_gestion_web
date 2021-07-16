<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\supplyChainSupplier;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class SupplierController extends AppBaseController
{
    /**
     * Display a listing of the Supplier.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
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
        return view('suppliers.index')->with('company_id',$company->id);
    }

    /**
     * Show the form for creating a new Supplier.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('suppliers.create')->with('company_id',$id);
    }

    /**
     * Store a newly created Supplier in storage.
     *
     * @param CreateSupplierRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplierRequest $request)
    {
        $input = $request->all();

        /** @var Supplier $supplier */
        $supplier = Supplier::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/suppliers.singular')]));

        return redirect(route('suppliers.index',[$supplier->company_id]));
    }

    /**
     * Display the specified Supplier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id,$id2)
    {
        /** @var Supplier $supplier */
        $supplier = Supplier::find($id2);

        if (empty($supplier)) {
            Flash::error(__('models/suppliers.singular').' '.__('messages.not_found'));

            return redirect(route('companies.index',[$id]));
        }

        return view('suppliers.show')->with('supplier', $supplier)->with('company_id',$supplier->company_id);
    }

    /**
     * Show the form for editing the specified Supplier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2)
    {

        /** @var Supplier $supplier */
        $supplier = Supplier::find($id2);

        if (empty($supplier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/suppliers.singular')]));

            return redirect(route('companies.index'));
        }

        return view('suppliers.edit')->with('supplier', $supplier)->with('company_id',$supplier->company_id);
    }

    /**
     * Update the specified Supplier in storage.
     *
     * @param int $id
     * @param UpdateSupplierRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, UpdateSupplierRequest $request)
    {
        /** @var Supplier $supplier */
        $supplier = Supplier::find($id2);

        if (empty($supplier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/suppliers.singular')]));

            return redirect(route('companies.index'));
        }

        $supplier->fill($request->all());
        $supplier->save();

        Flash::success(__('messages.updated', ['model' => __('models/suppliers.singular')]));
        return redirect(route('suppliers.index',[$supplier->company_id]));
    }

    /**
     * Remove the specified Supplier from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        /** @var Supplier $supplier */
        $supplier = Supplier::find($id2);
        $supplyChain = supplyChainSupplier::where('supplier_id','=',$supplier->id)->get();
        if (count($supplyChain)>0)
        {
            Flash::error('El recurso no se puede eliminar debido a la existencia de recursos relacionados.');
            return redirect(route('suppliers.index',[$supplier->company_id]));
        }
        if (empty($supplier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/suppliers.singular')]));

            return redirect(route('companies.index'));
        }

        $supplier->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/suppliers.singular')]));

        return redirect(route('suppliers.index',[$supplier->company_id]));

    }
    public function getSuppliers($id,Request $request)
    {
        //if($request->ajax()){
            $suppliers = Supplier::where('company_id','=',$id)->get();
            return response()->json($suppliers);
        //}
    }
}
