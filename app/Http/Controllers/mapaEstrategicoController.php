<?php

namespace App\Http\Controllers;

use App\Models\objectiveCompany;
use App\Models\Perspective;
use App\Models\Process;
use App\Models\processMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class mapaEstrategicoController extends Controller
{
    public function show($id, $id2, $id3, $id4, Request $request)
    {
        //$perspectives = Perspective::where('process_id',$id4)->get();
        $proceso = Process::find($id4);
        //Cargar objetivos empresa
        $processMap = processMap::find($id2);
        $objetivosEmpresa = objectiveCompany::where('company_id',$id)->get();
        return view('matriz_priorizados.process_priorizados.index',compact('proceso'))
        ->with('company_id',$id)
        ->with('process_map_id',$id2)
        ->with('matriz_priorizado_id',$id3)
        ->with('process_id',$id4)
        ->with('objetivos_empresa',$objetivosEmpresa)
        ->with('processMap',$processMap);
    }
    public function indicador(Request $request)
    {
        $indicador_select = 1;
        return Redirect::back()
        ->with('indicador_select',$indicador_select);
    }
}
