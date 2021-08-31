<?php

namespace App\Http\Controllers;

use App\Models\Perspective;
use App\Models\Process;
use Illuminate\Http\Request;

class mapaEstrategicoController extends Controller
{
    public function show($id, $id2, $id3, $id4, Request $request)
    {
        //$perspectives = Perspective::where('process_id',$id4)->get();
        $proceso = Process::find($id4);
        return view('matriz_priorizados.process_priorizados.index',compact('proceso'))
        ->with('company_id',$id)
        ->with('process_map_id',$id2)
        ->with('matriz_priorizado_id',$id3)
        ->with('process_id',$id4);
    }
}
