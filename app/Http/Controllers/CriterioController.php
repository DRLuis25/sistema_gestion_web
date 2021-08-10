<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCriterioRequest;
use App\Http\Requests\UpdateCriterioRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Criterio;
use App\Models\processMap;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class CriterioController extends AppBaseController
{
    /**
     * Display a listing of the Criterio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2, Request $request)
    {
        //$criterios = Criterio::where('process_map_id','=',$id2)->get();
        if($request->ajax()){
            /** @var Criterio $criterios */
            $criterios = Criterio::where('process_map_id','=',$id2)->with('processMap.company')->get();
            return DataTables::of($criterios)
            ->addColumn('action','criterios.actions')
            ->addColumn('test',function($criterio){
                return $criterio->processMap->company_id;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('criterios.index')->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for creating a new Criterio.
     *
     * @return Response
     */
    public function create($id, $id2)
    {
        //Verificar si ya está registrada la priorización
        return view('criterios.create')->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Store a newly created Criterio in storage.
     *
     * @param CreateCriterioRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, CreateCriterioRequest $request)
    {
        $input = $request->all();

        /** @var Criterio $criterio */
        $criterio = Criterio::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/criterios.singular')]));

        return redirect(route('criterios.index',[$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Display the specified Criterio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2, $id3)
    {
        /** @var Criterio $criterio */
        $criterio = Criterio::find($id3);

        if (empty($criterio)) {
            Flash::error(__('models/criterios.singular').' '.__('messages.not_found'));

            return redirect(route('criterios.index'));
        }

        return view('criterios.show')->with('criterio', $criterio)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for editing the specified Criterio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2, $id3)
    {
        /** @var Criterio $criterio */
        $criterio = Criterio::find($id3);

        if (empty($criterio)) {
            Flash::error(__('messages.not_found', ['model' => __('models/criterios.singular')]));

            return redirect(route('criterios.index'));
        }

        return view('criterios.edit')->with('criterio', $criterio)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Update the specified Criterio in storage.
     *
     * @param int $id
     * @param UpdateCriterioRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, $id3, UpdateCriterioRequest $request)
    {
        /** @var Criterio $criterio */
        $criterio = Criterio::find($id3);

        if (empty($criterio)) {
            Flash::error(__('messages.not_found', ['model' => __('models/criterios.singular')]));

            return redirect(route('criterios.index',[$id, $id2]));
        }

        $criterio->fill($request->all());
        $criterio->save();

        Flash::success(__('messages.updated', ['model' => __('models/criterios.singular')]));

        return redirect(route('criterios.index',[$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Remove the specified Criterio from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2, $id3)
    {
        /** @var Criterio $criterio */
        $criterio = Criterio::find($id3);

        if (empty($criterio)) {
            Flash::error(__('messages.not_found', ['model' => __('models/criterios.singular')]));

            return redirect(route('criterios.index',[$id, $id2]));
        }

        $criterio->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/criterios.singular')]));

        return redirect(route('criterios.index',[$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
    }
}
