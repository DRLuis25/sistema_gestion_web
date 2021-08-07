<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesupplyChainRequest;
use App\Http\Requests\UpdatesupplyChainRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\businessUnit;
use App\Models\Company;
use App\Models\supplyChain;
use App\Models\supplyChainCustomer;
use App\Models\supplyChainSupplier;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class supplyChainController extends AppBaseController
{
    /**
     * Display a listing of the supplyChain.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
    {

        $company = Company::find($id);
        if($request->ajax()){
            /** @var supplyChain $supplyChains */
            $supplyChains = supplyChain::where('company_id','=',$company->id)->get();
            return DataTables::of($supplyChains)
            ->addColumn('businessUnit',function($supplyChain){
                return $supplyChain->businessUnit->name;
            })
            ->addColumn('action','supply_chains.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('supply_chains.index',compact('company'))->with('company_id',$company->id);


    }

    /**
     * Show the form for creating a new supplyChain.
     *
     * @return Response
     */
    public function create($id)
    {
        $business_units = businessUnit::where('company_id','=',$id)->get();
        return view('supply_chains.create',compact('business_units'))->with('company_id',$id);
    }

    /**
     * Store a newly created supplyChain in storage.
     *
     * @param CreatesupplyChainRequest $request
     *
     * @return Response
     */
    public function store(CreatesupplyChainRequest $request)
    {
        $input = $request->all();

        /** @var supplyChain $supplyChain */
        $supplyChain = supplyChain::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/supplyChains.singular')]));

        return redirect(route('supplyChains.index',[$supplyChain->company_id,$supplyChain->id]));
    }

    /**
     * Display the specified supplyChain.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2)
    {
        /** @var supplyChain $supplyChain */
        $supplyChain = supplyChain::find($id2);

        if (empty($supplyChain)) {
            Flash::error(__('models/supplyChains.singular').' '.__('messages.not_found'));

            return redirect(route('supplyChains.index',[$id]));
        }

        return view('supply_chains.show')->with('supplyChain', $supplyChain)->with('company_id',$id);
    }

    /**
     * Show the form for editing the specified supplyChain.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2)
    {
        /** @var supplyChain $supplyChain */
        $supplyChain = supplyChain::find($id2);

        if (empty($supplyChain)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChains.singular')]));

            return redirect(route('companies.index'));
        }

        return view('supply_chains.edit')->with('supplyChain', $supplyChain)->with('company_id',$supplyChain->company_id);
    }

    /**
     * Update the specified supplyChain in storage.
     *
     * @param int $id
     * @param UpdatesupplyChainRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, UpdatesupplyChainRequest $request)
    {
        /** @var supplyChain $supplyChain */
        $supplyChain = supplyChain::find($id2);

        if (empty($supplyChain)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChains.singular')]));

            return redirect(route('companies.index'));
        }

        $supplyChain->fill($request->all());
        $supplyChain->save();

        Flash::success(__('messages.updated', ['model' => __('models/supplyChains.singular')]));

        return redirect(route('supplyChains.index',[$id]));
    }

    /**
     * Remove the specified supplyChain from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        /** @var supplyChain $supplyChain */
        $supplyChain = supplyChain::find($id2);

        if (empty($supplyChain)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChains.singular')]));

            return redirect(route('companies.index'));
        }
        $supplyChain->status = 0;
        $supplyChain->save();
        //$supplyChain->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/supplyChains.singular')]));

        return redirect(route('supplyChains.index',[$supplyChain->company_id]));
    }

    public function generateSupplyChain($id)
    {
        //id: supply_chain_id
        $customers = supplyChainCustomer::where('supply_chain_id','=',$id)
        ->join('customers','customers.id','=','supply_chain_customers.customer_id')
        ->select('supply_chain_customers.customer_id as id',
        'customers.name',
        'supply_chain_customers.parent_customer_id as parent_id')
        ->get();
        $suppliers = supplyChainSupplier::where('supply_chain_id','=',$id)
        ->join('suppliers','suppliers.id','=','supply_chain_suppliers.supplier_id')
        ->select('supply_chain_suppliers.supplier_id as id',
        'suppliers.name',
        'supply_chain_suppliers.parent_supplier_id as parent_id')
        ->get();
        foreach ($suppliers as $supplier) {
            $supplier->id = $supplier->id * -1;
            $supplier->parent_id = $supplier->parent_id * -1;
        }
        return response()->json([
            'customers'=>$customers,
            'suppliers'=>$suppliers
        ]);
    }
}
