<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesupplyChainCustomerRequest;
use App\Http\Requests\UpdatesupplyChainCustomerRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\supplyChainCustomer;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;
use Exception;

class supplyChainCustomerController extends AppBaseController
{
    /**
     * Display a listing of the supplyChainCustomer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var supplyChainCustomer $supplyChainCustomers */
            $supplyChainCustomers = supplyChainCustomer::all();
            return DataTables::of($supplyChainCustomers)
            ->addColumn('action','supply_chain_customers.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('supply_chain_customers.index');
    }

    /**
     * Show the form for creating a new supplyChainCustomer.
     *
     * @return Response
     */
    public function create()
    {
        return view('supply_chain_customers.create');
    }

    /**
     * Store a newly created supplyChainCustomer in storage.
     *
     * @param CreatesupplyChainCustomerRequest $request
     *
     * @return Response
     */
    public function store(CreatesupplyChainCustomerRequest $request)
    {
        try{
            $input = $request->all();
            $supplyChainCustomer = supplyChainCustomer::create($input);
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json(['status'=>'500'], 200);
        }
    }

    /**
     * Display the specified supplyChainCustomer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var supplyChainCustomer $supplyChainCustomer */
        $supplyChainCustomer = supplyChainCustomer::find($id);

        if (empty($supplyChainCustomer)) {
            Flash::error(__('models/supplyChainCustomers.singular').' '.__('messages.not_found'));

            return redirect(route('supplyChainCustomers.index'));
        }

        return view('supply_chain_customers.show')->with('supplyChainCustomer', $supplyChainCustomer);
    }

    /**
     * Show the form for editing the specified supplyChainCustomer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var supplyChainCustomer $supplyChainCustomer */
        $supplyChainCustomer = supplyChainCustomer::find($id);

        if (empty($supplyChainCustomer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChainCustomers.singular')]));

            return redirect(route('supplyChainCustomers.index'));
        }

        return view('supply_chain_customers.edit')->with('supplyChainCustomer', $supplyChainCustomer);
    }

    /**
     * Update the specified supplyChainCustomer in storage.
     *
     * @param int $id
     * @param UpdatesupplyChainCustomerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesupplyChainCustomerRequest $request)
    {
        /** @var supplyChainCustomer $supplyChainCustomer */
        $supplyChainCustomer = supplyChainCustomer::find($id);

        if (empty($supplyChainCustomer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChainCustomers.singular')]));

            return redirect(route('supplyChainCustomers.index'));
        }

        $supplyChainCustomer->fill($request->all());
        $supplyChainCustomer->save();

        Flash::success(__('messages.updated', ['model' => __('models/supplyChainCustomers.singular')]));

        return redirect(route('supplyChainCustomers.index'));
    }

    /**
     * Remove the specified supplyChainCustomer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var supplyChainCustomer $supplyChainCustomer */
        $supplyChainCustomer = supplyChainCustomer::find($id);
        $company_id = $supplyChainCustomer->supplyChain->company_id;
        $cod = $supplyChainCustomer->supply_chain_id;

        if (empty($supplyChainCustomer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/supplyChainCustomers.singular')]));

            return redirect(route('supplyChainCustomers.index'));
        }

        $supplyChainCustomer->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/supplyChainCustomers.singular')]));

        return redirect()->route('supplyChains.show', [$company_id,$cod]);
    }

    /**
     * Show the form for editing the specified supplyChainCustomer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function getSupplyChainCustomers($id,Request $request)
    {
        /*$supplyChainCustomers = supplyChainCustomer::where('supply_chain_id','=',$id)
            ->with('supplyChain','customer','parentCustomer')
            ->get();
            return $supplyChainCustomers[0];*/
        if($request->ajax()){
            $supplyChainCustomers = supplyChainCustomer::where('supply_chain_id','=',$id)
            ->with('supplyChain','customer','parentCustomer')
            ->get();
            return DataTables::of($supplyChainCustomers)
            /*->addColumn('supply_chain_name',function($value){
                return $value->supplyChain->businessUnit->name;
            })*/
            ->addColumn('customer_name',function($value){
                return $value->customer->name;
            })
            ->addColumn('parent_customer_name',function($value){
                if($value->parentCustomer!=null)
                    return $value->parentCustomer->name;
                else
                    return 'Esta empresa';
            })
            ->addColumn('action','supply_chain_customers.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
    }


    /**
     * Show the form for editing the specified supplyChainCustomer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function getSupplyChainCustomerParents($id, $id2, Request $request)
    {
        if($request->ajax()){
            $getSupplyChainCustomer = supplyChainCustomer::where('supply_chain_id','=',$id)
            ->where('level','=',$id2)
            ->with('customer')
            ->get();
            return response()->json($getSupplyChainCustomer);
        }
    }
}
