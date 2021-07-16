<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatehistorialRequest;
use App\Http\Requests\UpdatehistorialRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\historial;
use App\Models\supplyChain;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class historialController extends AppBaseController
{
    /**
     * Display a listing of the historial.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var historial $historials */
            $historials = historial::all();
            return DataTables::of($historials)
            ->addColumn('action','historials.actions')
            ->addColumn('created',function($historial){
                return date('d-m-Y H:i:s',strtotime($historial->created_at));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('historials.index');
    }

    /**
     * Show the form for creating a new historial.
     *
     * @return Response
     */
    public function create()
    {
        return view('historials.create');
    }

    /**
     * Store a newly created historial in storage.
     *
     * @param CreatehistorialRequest $request
     *
     * @return Response
     */
    public function store(CreatehistorialRequest $request)
    {
        try{
            $input = $request->all();
            $historial = historial::create($input);
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json(['status'=>'500','message'=>$e->getMessage()], 200);
        }
    }

    /**
     * Display the specified historial.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var historial $historial */
        $historial = historial::find($id);

        if (empty($historial)) {
            Flash::error(__('models/historials.singular').' '.__('messages.not_found'));

            return redirect(route('historials.index'));
        }

        return view('historials.show')->with('historial', $historial);
    }

    /**
     * Show the form for editing the specified historial.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var historial $historial */
        $historial = historial::find($id);

        if (empty($historial)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historials.singular')]));

            return redirect(route('historials.index'));
        }

        return view('historials.edit')->with('historial', $historial);
    }

    /**
     * Update the specified historial in storage.
     *
     * @param int $id
     * @param UpdatehistorialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatehistorialRequest $request)
    {
        /** @var historial $historial */
        $historial = historial::find($id);

        if (empty($historial)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historials.singular')]));

            return redirect(route('historials.index'));
        }

        $historial->fill($request->all());
        $historial->save();

        Flash::success(__('messages.updated', ['model' => __('models/historials.singular')]));

        return redirect(route('historials.index'));
    }

    /**
     * Remove the specified historial from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var historial $historial */
        $historial = historial::find($id);
        $supplyChain = supplyChain::find($historial->supply_chain_id);
        $company_id = $supplyChain->company_id;
        $cod = $supplyChain->id;
        if (empty($historial)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historials.singular')]));

            return redirect(route('historials.index'));
        }

        $historial->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/historials.singular')]));

        //return redirect(route('historials.index'));
        return redirect()->route('supplyChains.show',[$company_id, $cod]);
    }
/**
     * Show the form for editing the specified getHistorial.
     *
     * @param int $id
     *
     * @return Response
     */
    public function getHistorial($id,Request $request)
    {
        /*$supplyChainCustomers = supplyChainCustomer::where('supply_chain_id','=',$id)
            ->with('supplyChain','customer','parentCustomer')
            ->get();
            return $supplyChainCustomers[0];*/
        if($request->ajax()){
            /** @var historial $historials */
            $historials = historial::where('supply_chain_id','=',$id)->get();
            return DataTables::of($historials)
            ->addColumn('action','historials.actions')
            ->addColumn('created',function($historial){
                return date('d-m-Y H:i:s',strtotime($historial->created_at));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
