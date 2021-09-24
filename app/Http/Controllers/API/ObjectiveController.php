<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Objective;
use App\Models\Perspective;
use Illuminate\Http\Request;
use Response;
use Exception;
use Yajra\DataTables\DataTables;
class ObjectiveController extends AppBaseController
{
    public function getObjectives($id, $id2, $id3, Request $request)
    {
        //id: matriz_priorizado_id
        //id2: process_id
        //id3: perspective_id
        //if($request->ajax()){
            $objetivos = Objective::where('objectives.matriz_priorizado_id',$id)
            ->where('objectives.process_id',$id2)
            ->where('orden','<=',$id3)
            ->selectRaw('objectives.id,
            objectives.matriz_priorizado_id,
            objectives.process_id,
            objectives.perspective_id,
            objectives.descripcion,
            perspectives.orden,
            objectives.efecto
            ')
            ->join('perspectives','perspectives.id','=','objectives.perspective_id')
            ->get();
            return response()->json($objetivos);
        //}
    }
    public function storeObjective(Request $request)
    {
        try{
            $efecto = null;
            if ($request->nuevo=='1') {
                unset($request->objetivo_company);
            }
            if (!is_null($request->effect_id)) {
                $efecto = json_encode($request->effect_id);
            }
            $objective = Objective::create([
                'matriz_priorizado_id' =>  $request->matriz_priorizado_id,
                'process_id' => $request->process_id,
                'perspective_id' => $request->perspective_id,
                'descripcion' => $request->descripcion,
                'efecto' => $efecto,
                'nuevo' => $request->nuevo,
                'objectives_company_id' => $request->objetivo_company
            ]);
            return Response::json([
                'status'=>'200',
                'e' => $objective
        ], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json([
                'status'=>'500','e'=> $e->getMessage()
            ], 200);
        }
    }
    /* public function deleteObjective($id, Request $request)
    {
        try{
            $input = $request->all();
            $objective = Objective::find($id);
            return Response::json([
                'status'=>'200',
                'e' => $objective
        ], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json([
                'status'=>'500','e'=> $e->getMessage()
            ], 200);
        }
    } */
}
