<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatematrizPriorizadoRequest;
use App\Http\Requests\UpdatematrizPriorizadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\matrizPriorizado;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class matrizPriorizadoController extends AppBaseController
{
    /**
     * Display a listing of the matrizPriorizado.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2, Request $request)
    {
        if($request->ajax()){
            /** @var matrizPriorizado $matrizPriorizados */
            $matrizPriorizados = matrizPriorizado::where('process_map_id','=',$id2)->withTrashed()->get();
            return DataTables::of($matrizPriorizados)
            ->addColumn('num_priorizados',function($matrizPriorizados){
                return count(json_decode($matrizPriorizados->process_id_data_all));
            })
            ->addColumn('company_id',function($matrizPriorizados){
                return $matrizPriorizados->processMap->company_id;
            })
            ->addColumn('action','matriz_priorizados.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('matriz_priorizados.index')->with('company_id', $id)->with('process_map_id', $id2);
    }

    /**
     * Show the form for creating a new matrizPriorizado.
     *
     * @return Response
     */
    public function create($id, $id2)
    {
        return view('matriz_priorizados.create')->with('company_id', $id)->with('process_map_id', $id2);
    }

    /**
     * Store a newly created matrizPriorizado in storage.
     *
     * @param CreatematrizPriorizadoRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, CreatematrizPriorizadoRequest $request)
    {
        $input = $request->all();

        /** @var matrizPriorizado $matrizPriorizado */
        $matrizPriorizado = matrizPriorizado::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/matrizPriorizados.singular')]));

        return redirect(route('matrizPriorizados.index',[$id, $id2]));
    }

    /**
     * Display the specified matrizPriorizado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2, $id3)
    {
        /** @var matrizPriorizado $matrizPriorizado */
        $matrizPriorizado = matrizPriorizado::find($id3);

        if (empty($matrizPriorizado)) {
            Flash::error(__('models/matrizPriorizados.singular').' '.__('messages.not_found'));

            return redirect(route('matrizPriorizados.index',[$id, $id2]));
        }

        return view('matriz_priorizados.show')->with('matrizPriorizado', $matrizPriorizado)->with('company_id', $id)->with('process_map_id', $id2);
    }

    /**
     * Show the form for editing the specified matrizPriorizado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2, $id3)
    {
        /** @var matrizPriorizado $matrizPriorizado */
        $matrizPriorizado = matrizPriorizado::find($id3);

        if (empty($matrizPriorizado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizPriorizados.singular')]));

            return redirect(route('matrizPriorizados.index',[$id, $id2]));
        }

        return view('matriz_priorizados.edit')->with('matrizPriorizado', $matrizPriorizado)->with('company_id', $id)->with('process_map_id', $id2);
    }

    /**
     * Update the specified matrizPriorizado in storage.
     *
     * @param int $id
     * @param UpdatematrizPriorizadoRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, $id3, UpdatematrizPriorizadoRequest $request)
    {
        /** @var matrizPriorizado $matrizPriorizado */
        $matrizPriorizado = matrizPriorizado::find($id3);

        if (empty($matrizPriorizado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizPriorizados.singular')]));

            return redirect(route('matrizPriorizados.index',[$id, $id2]));
        }

        $matrizPriorizado->fill($request->all());
        $matrizPriorizado->save();

        Flash::success(__('messages.updated', ['model' => __('models/matrizPriorizados.singular')]));

        return redirect(route('matrizPriorizados.index',[$id, $id2]));
    }

    /**
     * Remove the specified matrizPriorizado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2, $id3)
    {
        /** @var matrizPriorizado $matrizPriorizado */
        $matrizPriorizado = matrizPriorizado::find($id3);

        if (empty($matrizPriorizado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizPriorizados.singular')]));

            return redirect(route('matrizPriorizados.index',[$id, $id2]));
        }

        $matrizPriorizado->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/matrizPriorizados.singular')]));

        return redirect(route('matrizPriorizados.index',[$id, $id2]));
    }
    public function activate($id, $id2, $id3)
    {

        /** @var matrizPriorizado $matrizPriorizado */
        $eliminar = matrizPriorizado::where('process_map_id','=',$id2)->delete();
        $matrizPriorizado = matrizPriorizado::withTrashed()->where("id",$id3)->first();

        if (empty($matrizPriorizado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/matrizPriorizados.singular')]));

            return redirect(route('matrizPriorizados.index',[$id, $id2]));
        }
        $matrizPriorizado->restore();

        Flash::success(__('messages.deleted', ['model' => __('models/matrizPriorizados.singular')]));

        return redirect(route('matrizPriorizados.index',[$id, $id2]));
    }
}
