<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Perspective;
use Illuminate\Http\Request;

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

}
