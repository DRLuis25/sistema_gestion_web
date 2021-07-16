<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesupplyChainSupplierRequest;
use App\Http\Requests\UpdatesupplyChainSupplierRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\supplyChainCustomer;
use App\Models\supplyChainSupplier;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class supplyChainSupplierController extends AppBaseController
{
    /**
     * Display a listing of the supplyChainSupplier.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var supplyChainSupplier $supplyChainSuppliers */
            $supplyChainSuppliers = supplyChainSupplier::all();
            return DataTables::of($supplyChainSuppliers)
            ->addColumn('action','supply_chain_suppliers.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('supply_chain_suppliers.index');
    }

    /**
     * Show the form for creating a new supplyChainSupplier.
     *
     * @return Response
     */
    public function create()
    {
        return view('supply_chain_suppliers.create');
    }

    /**
     * Store a newly created supplyChainSupplier in storage.
     *
     * @param CreatesupplyChainSupplierRequest $request
     *
     * @return Response
     */
    public function store(CreatesupplyChainSupplierRequest $request)
    {
        try{
            $input = $request->all();
            $supplyChainSupplier = supplyChainSupplier::create($input);
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json(['status'=>'500'], 200);
        }
    }

    /**
     * Display the specified supplyChainSupplier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var supplyChainSupplier $supplyChainSupplier */
        $supplyChainSupplier = supplyChainSupplier::find($id);

        if (empty($supplyChainSupplier)) {
            Flash::error(__('models/supplyChainSuppliers.singular').' '.__('messages.not_found'));

            return redirect(route('supplyChainSuppliers.index'));
        }

        return view('supply_chain_suppliers.show')->with('supplyChainSupplier', $supplyChainSupplier);
    }

    /**
     * Show the form for editing the specified supplyChainSupplier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var supplyChainSupplier $supplyChainSupplier */
        $supplyChainSupplier = supplyChainSupplier::find($id);

        if (empty($supplyChainSupplier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChainSuppliers.singular')]));

            return redirect(route('supplyChainSuppliers.index'));
        }

        return view('supply_chain_suppliers.edit')->with('supplyChainSupplier', $supplyChainSupplier);
    }

    /**
     * Update the specified supplyChainSupplier in storage.
     *
     * @param int $id
     * @param UpdatesupplyChainSupplierRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesupplyChainSupplierRequest $request)
    {
        /** @var supplyChainSupplier $supplyChainSupplier */
        $supplyChainSupplier = supplyChainSupplier::find($id);

        if (empty($supplyChainSupplier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChainSuppliers.singular')]));

            return redirect(route('supplyChainSuppliers.index'));
        }

        $supplyChainSupplier->fill($request->all());
        $supplyChainSupplier->save();

        Flash::success(__('messages.updated', ['model' => __('models/supplyChainSuppliers.singular')]));

        return redirect(route('supplyChainSuppliers.index'));
    }

    /**
     * Remove the specified supplyChainSupplier from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var supplyChainSupplier $supplyChainSupplier */
        $supplyChainSupplier = supplyChainSupplier::find($id);
        $company_id = $supplyChainSupplier->supplyChain->company_id;
        $cod = $supplyChainSupplier->supply_chain_id;
        if (empty($supplyChainSupplier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChainSuppliers.singular')]));

            return redirect(route('supplyChainSuppliers.index'));
        }

        $supplyChainSupplier->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/supplyChainSuppliers.singular')]));
        //return $company_id.'-'.$cod;
        return redirect()->route('supplyChains.show',[$company_id, $cod]);
        //return redirect(route('supplyChainSuppliers.index'));
    }

    /**
     * Show the form for editing the specified supplyChainCustomer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function getSupplyChainSuppliers($id,Request $request)
    {
        if($request->ajax()){
            $supplyChainSupplier = supplyChainSupplier::where('supply_chain_id','=',$id)
            ->with('supplyChain','supplier','parentSupplier')
            ->get();
            return DataTables::of($supplyChainSupplier)
                ->addColumn('supplier_name',function($value){
                    return $value->supplier->name;
                })
                ->addColumn('parent_supplier_name',function($value){
                    if($value->parentSupplier!=null)
                        return $value->parentSupplier->name;
                    else
                        return 'Esta empresa';
                })
                ->addColumn('action','supply_chain_suppliers.actions')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified supplyChainSupplier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function getSupplyChainSupplierParents($id, $id2, Request $request)
    {
        if($request->ajax()){
            $supplyChainSupplier = supplyChainSupplier::where('supply_chain_id','=',$id)
            ->where('level','=',$id2)
            ->with('supplier')
            ->get();
            return response()->json($supplyChainSupplier);
        }
    }
}
