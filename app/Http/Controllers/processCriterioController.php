<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprocessCriterioRequest;
use App\Http\Requests\UpdateprocessCriterioRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Criterio;
use App\Models\matrizPriorizado;
use App\Models\Process;
use App\Models\processCriterio;
use App\Models\processMap;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class processCriterioController extends AppBaseController
{
    /**
     * Display a listing of the processCriterio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getMatrizPriorizacion($id, Request $request)
    {
        if($request->ajax()){
            $processCriterio = processCriterio::where('process_map_id','=',$id)->first();
            return response()->json([
                'matriz'=>$processCriterio
            ]);
        }
    }
    public function index($id, $id2, Request $request)
    {
        /** @var processCriterio $processCriterios */
        $procesos = Process::where('process_map_id','=','1')->whereNull('parent_process_id')->get();
        $criterios = Criterio::where('process_map_id','=','1')->get();
        return view('process_criterios.index',compact('procesos','criterios'))->with('company_id',$id)->with('process_map_id',$id2);
    }
    public function selectPriorizar($id, $id2)
    {
        $processCriterio = processCriterio::find($id2);
        $ids = json_decode($processCriterio->process_id_data);
        $values = json_decode($processCriterio->process_values_data);
        $procesosPriorizados = array();
        foreach ($ids as $key => $value) {
            $temp = Process::find($value);
            $temp->value = $values[$key];
            $procesosPriorizados[] = $temp;
        }
        //array_slice(json_decode($processCriterio->process_id_data),0,3);
        return view('process_criterios.priorizar',compact('procesosPriorizados'))->with('processCriterio',$processCriterio)->with('company_id',$id)->with('process_map_id',$id2);
    }
    public function storePriorizar($id, $id2, Request $request)
    {
        //return $request;
        $processCriterio = processCriterio::find($id2);
        $ids = json_decode($processCriterio->process_id_data);
        $priorizados = array_slice(json_decode($processCriterio->process_id_data),0,$request->nro_priorizar);
        $values = array_slice(json_decode($processCriterio->process_values_data),0,$request->nro_priorizar);
        //return $priorizados; //Array procesos priorizados
        /*$procesosPriorizados = array();
        foreach ($priorizados as $key => $value) {
            $temp = Process::find($value);
            $temp->value = $priorizados[$key];
            $procesosPriorizados[] = $temp;
        }
        return $procesosPriorizados;*/
        $eliminar = matrizPriorizado::where('process_map_id','=',$processCriterio->id)->delete();
        //return $eliminar;
        $matrizPriorizado = matrizPriorizado::create([
            'process_map_id' => $id2,
            'process_criterio_id' => $processCriterio->id,
            'description' => $request->description,
            'process_id_data' => json_encode($priorizados),
            'process_id_data_all' => json_encode($priorizados),
            'process_id_data_flow_diagram' => json_encode($priorizados),
            'process_id_data_seguimiento' => json_encode($priorizados),
            'process_values_data' => json_encode($values),
        ]);
        Flash::success(__('messages.saved', ['model' => __('models/matrizPriorizados.singular')]));
        return redirect(route('matrizPriorizados.index', [$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
    }
    /**
     * Store a newly created processCriterio in storage.
     *
     * @param CreateprocessCriterioRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, Request $request)
    {
        //return $request;
        $input = $request->except('_token','subtotal','id');

        $ordenado = $this->orderArrays($request->id,$request->subtotal);
        $data = json_encode($input);
        $process_id_data = json_encode($ordenado[0]);
        //return $ordenado[0];
        $procesosCambioEstado = Process::whereIn('id', $ordenado[0])->update(array('status'=>true));
        //return $procesosCambioEstado;
        $process_values_data = json_encode($ordenado[1]);
        $processCriterio = processCriterio::firstOrCreate(['process_map_id' => $id2], [
            'data' => $data,
            'process_id_data' => $process_id_data,
            'process_values_data' => $process_values_data,
        ]);
        $processCriterio->data = $data;
        $processCriterio->process_id_data = $process_id_data;
        $processCriterio->process_values_data = $process_values_data;
        $processCriterio->save();
        $processMap = processMap::where('id','=','1')->first();
        $processMap->status = true;
        Flash::success(__('messages.saved', ['model' => __('models/processCriterios.singular')]));
        return redirect(route('processCriterios.index', [$id, $id2]))->with('company_id',$id)->with('process_map_id',$id2);
    }
    public function orderArrays($array, $array2)
    {
        //return $array;
        $n = count($array);
        for ($i=0; $i < $n; $i++) {
            for ($j=$i+1; $j < $n ; $j++) {
                if ($array2[$j]>$array2[$i]) {
                    $temp = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $temp;
                    $temp = $array2[$i];
                    $array2[$i] = $array2[$j];
                    $array2[$j] = $temp;
                }
            }
        }
        return array($array,$array2);
    }
}

