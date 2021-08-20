<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRolRequest;
use App\Http\Requests\UpdateRolRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Rol;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class RolController extends AppBaseController
{
    /**
     * Display a listing of the Rol.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2, Request $request)
    {
        if($request->ajax()){
            /** @var Rol $rols */
            $rols = Rol::where('process_map_id','=',$id2)->get();
            return DataTables::of($rols)
            ->addColumn('company_id',function($criterio){
                return $criterio->processMap->company_id;
            })
            ->addColumn('action','rols.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('rols.index')->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for creating a new Rol.
     *
     * @return Response
     */
    public function create($id, $id2)
    {
        return view('rols.create')->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Store a newly created Rol in storage.
     *
     * @param CreateRolRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, CreateRolRequest $request)
    {
        $input = $request->all();

        /** @var Rol $rol */
        $rol = Rol::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/rols.singular')]));

        return redirect(route('rols.index',[$id, $id2]));
    }

    /**
     * Display the specified Rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2, $id3)
    {
        /** @var Rol $rol */
        $rol = Rol::find($id3);

        if (empty($rol)) {
            Flash::error(__('models/rols.singular').' '.__('messages.not_found'));

            return redirect(route('rols.index',[$id, $id2]));
        }

        return view('rols.show')->with('rol', $rol)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Show the form for editing the specified Rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2, $id3)
    {
        /** @var Rol $rol */
        $rol = Rol::find($id3);

        if (empty($rol)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rols.singular')]));

            return redirect(route('rols.index',[$id, $id2]));
        }

        return view('rols.edit')->with('rol', $rol)->with('company_id',$id)->with('process_map_id',$id2);
    }

    /**
     * Update the specified Rol in storage.
     *
     * @param int $id
     * @param UpdateRolRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, $id3, UpdateRolRequest $request)
    {
        /** @var Rol $rol */
        $rol = Rol::find($id3);

        if (empty($rol)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rols.singular')]));

            return redirect(route('rols.index',[$id, $id2]));
        }

        $rol->fill($request->all());
        $rol->save();

        Flash::success(__('messages.updated', ['model' => __('models/rols.singular')]));

        return redirect(route('rols.index',[$id, $id2]));
    }

    /**
     * Remove the specified Rol from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2, $id3)
    {
        /** @var Rol $rol */
        $rol = Rol::where('id',$id3)->doesnthave('seguimientos')->first();
        //return $rol;
        if (empty($rol)) {
            Flash::error("Error al eliminar. No se encuentra el registro o está siendo utilizado en el diagrama de Seguimiento");

            return redirect(route('rols.index',[$id, $id2]));
        }

        $rol->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/rols.singular')]));

        return redirect(route('rols.index',[$id, $id2]));
    }
}
