<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePerspectiveRequest;
use App\Http\Requests\UpdatePerspectiveRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Perspective;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class PerspectiveController extends AppBaseController
{

    /**
     * Display a listing of the Perspective.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2,$id3,$id4,Request $request)
    {
        if($request->ajax()){
            /** @var Perspective $perspectives */
            $perspectives = Perspective::where('process_id',$id4)
            ->get();
            return DataTables::of($perspectives)
            ->addColumn('action','matriz_priorizados.process_priorizados.perspectivas.actions')
            ->addColumn('perspective_name',function($perspective){
                return $perspective->perspectiveCompany->descripcion;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store(CreatePerspectiveRequest $request)
    {
        $perspective = Perspective::all();
        $max = 0;

        foreach($perspective as $item)
        {
            if($max < $item->orden)
                $max = $item->orden;
        }

        $perspective = new Perspective();
        $perspective->process_id = $request->process_id;
        $perspective->descripcion = $request->descripcion;
        $perspective->orden = $max + 1;
        $perspective->save();

        //--------------------------------------------------------------
        $input = $request->all();

        /** @var Perspective $perspective */
        $perspective = Perspective::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/perspectives.singular')]));

        return redirect(route('perspectives.index'));
    }

    public function show($id)
    {
        /** @var Perspective $perspective */
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            Flash::error(__('models/perspectives.singular').' '.__('messages.not_found'));

            return redirect(route('perspectives.index'));
        }

        return view('perspectives.show')->with('perspective', $perspective);
    }

    public function edit($id)
    {
        /** @var Perspective $perspective */
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectives.singular')]));

            return redirect(route('perspectives.index'));
        }

        return view('perspectives.edit')->with('perspective', $perspective);
    }


    public function update($id, UpdatePerspectiveRequest $request)
    {
        /** @var Perspective $perspective */
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectives.singular')]));

            return redirect(route('perspectives.index'));
        }

        $perspective->fill($request->all());
        $perspective->save();

        Flash::success(__('messages.updated', ['model' => __('models/perspectives.singular')]));

        return redirect(route('perspectives.index'));
    }

    public function destroy($id)
    {
        //Para el destroy validar que no esté siendo usado en otras relaciones
        $perspective = Perspective::find($id);
        $company_id = $perspective->process->processMap->company_id;
        $process_map_id = $perspective->process->processMap->id;
        $matriz_priorizado_id = $perspective->process->processMap->matrizPriorizado->id;
        $process_id = $perspective->process_id;

        if (empty($perspective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectives.singular')]));

            return redirect(route('perspectives.index'));
        }

        $perspective->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/perspectives.singular')]));

        return redirect(route('mapaEstrategico.show',[$company_id,$process_map_id,$matriz_priorizado_id,$process_id]));

    }

}
