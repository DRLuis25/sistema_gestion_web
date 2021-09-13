<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateObjectiveRequest;
use App\Http\Requests\UpdateObjectiveRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Objective;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class ObjectiveController extends AppBaseController
{
    public function index($id, $id2,$id3,$id4, Request $request)
    {
        //id: matriz_priorizado_id
        //id2: process_id
        //id3: perspective_id
        $objetivos = Objective::where('matriz_priorizado_id',$id3)
        ->where('process_id',$id4)
        ->get();
        if($request->ajax()){
            return DataTables::of($objetivos)
            ->addColumn('perpectiva',function($objetivo){
                return $objetivo->perspective->perspectiveCompany->descripcion;
            })
            ->addColumn('action','matriz_priorizados.process_priorizados.objetivos.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    /**
     * Remove the specified Objective from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        //Para el destroy validar que no esté siendo usado en otras relaciones
        $objective = Objective::find($id);
        $company_id = $objective->process->processMap->company_id;
        $process_map_id = $objective->process->processMap->id;
        $matriz_priorizado_id = $objective->matriz_priorizado_id;
        $process_id = $objective->process_id;
        if (empty($objective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/objectives.singular')]));

            return redirect(route('matrizPriorizados.show',[$company_id,$process_map_id,$matriz_priorizado_id]));
        }

        $objective->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/objectives.singular')]));

        return redirect(route('mapaEstrategico.show',[$company_id,$process_map_id,$matriz_priorizado_id,$process_id]));
    }
}
