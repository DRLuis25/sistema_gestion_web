<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Perspective;
use App\Models\perspectiveCompany;
use Exception;
use Illuminate\Http\Request;
use Response;
class PerspectiveController extends AppBaseController
{
    public function getPerspectivas($id, Request $request)
    {
        //if($request->ajax()){
            /** @var Process $process */
            $process = Perspective::where('process_id','=',$id)->with('perspectiveCompany')->get();
            return response()->json($process);
        //}
    }

    public function getPerspectivasOrden($id, $id2, Request $request)
    {
        //if($request->ajax()){
            /** @var Process $process */
            $process = Perspective::where('process_id','=',$id)->where('orden','<',$id2)->with('perspectiveCompany')->get();
            return response()->json($process);
        //}
    }
    public function getPerspectivasEmpresa($id, Request $request)
    {
        //if($request->ajax()){
            /** @var Process $process */
            $process = perspectiveCompany::where('company_id','=',$id)->get();
            return response()->json($process);
        //}
    }
    public function storePerspectiva(Request $request)
    {
        $total = Perspective::where('process_id',$request->process_id)->where('matriz_priorizado_id',$request->matriz_priorizado_id)->get()->count();
        try{
            $perspective = Perspective::create([
                'matriz_priorizado_id' => $request->matriz_priorizado_id,
                'process_id' => $request->process_id,
                'perspective_company_id' => $request->perspective_company_id,
                'orden' => $total+1,
            ]);
            return Response::json([
                'status'=>'200',
                'e' => $perspective
            ], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json([
                'status'=>'500','e'=> $e->getMessage()
            ], 200);
        }
    }

}
