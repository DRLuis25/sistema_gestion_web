<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;

class mapaEstrategicoController extends Controller
{
    public function index($id, $id2, $id3, $id4, Request $request)
    {
        $proceso = Process::find($id4);
        return view('matriz_priorizados.process_priorizados.index',compact('proceso'))
        ->with('company_id',$id)
        ->with('process_map_id',$id2)
        ->with('matriz_priorizados',$id3);
    }
}
