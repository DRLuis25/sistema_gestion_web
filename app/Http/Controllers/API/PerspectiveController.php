<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Perspective;
use Illuminate\Http\Request;

class PerspectiveController extends AppBaseController
{
    public function getPerspectivas($id, Request $request)
    {
        if($request->ajax()){
            /** @var Process $process */
            $process = Perspective::where('process_id','=',$id)->get();
            return response()->json($process);
        }
    }
}
