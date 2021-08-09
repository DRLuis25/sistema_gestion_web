<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcessRequest;
use App\Http\Requests\UpdateProcessRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Company;
use App\Models\Process;
use App\Models\processMap;
use App\Models\processType;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Validator;
use Response;
use Yajra\DataTables\DataTables;

class ProcessController extends AppBaseController
{
    public function getProcess($id, Request $request)
    {
        if($request->ajax()){
            /** @var Process $process */
            $process = Process::where('process_map_id','=',$id)->whereNull('parent_process_id')->get();
            return DataTables::of($process)
            ->addColumn('company_id',function($process){
                return $process->processMap->company_id;
            })
            ->addColumn('processMap',function($process){
                return $process->process_map_id;
            })
            ->addColumn('type',function($process){
                return implode(', ',$process->processTypes->pluck('type')->pluck('description')->toArray());
            })
            ->addColumn('action','process_maps.process.actions')
            ->addColumn('proceso_show','process_maps.process.show_subprocess')
            ->rawColumns(['action','proceso_show'])
            ->make(true);
        }
    }
    public function getProcessById($id, Request $request)
    {
        //if($request->ajax()){
            $process = Process::find($id);
            $type = implode(', ',$process->processTypes->pluck('type')->pluck('description')->toArray());
            //return $process;
            return response()->json([
                'process'=>$process,
                'types'=>$type
            ]);
        //}
        //implode(', ',$process->processTypes->pluck('type')->pluck('description')->toArray());
    }
    /**
     * Display a listing of the Process.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, Request $request)
    {
        $company = Company::find($id);
        if($request->ajax()){
            /** @var Process $process */
            $process = Process::where('process_map_id','=',$id)->get();
            return DataTables::of($process)
            ->addColumn('action','process.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('process.index',compact('company'))->with('company_id',$company->id);;
    }

    /**
     * Show the form for creating a new Process.
     *
     * @return Response
     */
    public function create()
    {
        return view('process.create');
    }

    /**
     * Store a newly created Process in storage.
     *
     * @param CreateProcessRequest $request
     *
     * @return Response
     */
    public function store(CreateProcessRequest $request)
    {
        try{
            $input = $request->all();
            /** @var Process $process */
            $process = Process::create($input);
            foreach ($request->type as $key => $value) {
                $processType = processType::create([
                    'process_id' =>  $process->id,
                    'type_id' => $value,
                ]);
            }
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json(['status'=>'500','e'=> $e->getMessage()], 200);
        }
    }

    /**
     * Display the specified Process.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Process $process */
        $process = Process::find($id);

        if (empty($process)) {
            Flash::error(__('models/processes.singular').' '.__('messages.not_found'));

            return redirect(route('process.index'));
        }

        return view('process.show')->with('process', $process);
    }

    /**
     * Show the form for editing the specified Process.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Process $process */
        $process = Process::find($id);

        if (empty($process)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processes.singular')]));

            return redirect(route('process.index'));
        }

        return view('process.edit')->with('process', $process);
    }

    /**
     * Update the specified Process in storage.
     *
     * @param int $id
     * @param UpdateProcessRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), Process::$updateRules);

        if ($validator->fails()) {
            return Response::json(['status'=>'500','e'=>$validator->errors()->first()], 200);
        }
        try{
            /** @var Process $process */
            $process = Process::find($id);
            $process->fill($request->all());
            $process->save();
            return Response::json(['status'=>'200'], 200);
        }
        catch(Exception $e){
            //return Response::json(['error'=>$e->getMessage()], 500);
            return Response::json(['status'=>'500'], 200);
        }
    }

    /**
     * Remove the specified Process from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2)
    {
        $processMap = processMap::find($id);
        /** @var Process $process */
        $process = Process::find($id2);

        if (empty($process)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processes.singular')]));

            return redirect(route('companies.index'));
        }

        $process->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/processes.singular')]));

        return redirect(route('processMaps.show',[$processMap->company_id,$processMap->id]));
    }
    public function getProcessMap($id, Request $request)
    {
        //id: processMap_id
        /** @var Process $process */
        $process = Process::where('process_map_id','=',$id)
        ->join('process_type','process.id','=','process_type.process_id')
        ->join('types','process_type.type_id','=','types.id')
        ->select('process_type.id as id','process.name as name','type_id as type')
        ->whereNull('parent_process_id')
        ->whereNull('deleted_at')
        ->orderBy('process_type.type_id')
        ->get();
        return response()->json([
            'process'=>$process,
        ]);

        return $process;
    }
}
