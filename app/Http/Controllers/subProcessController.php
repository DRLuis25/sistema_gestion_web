<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesubProcessRequest;
use App\Http\Requests\UpdatesubProcessRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\subProcess;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class subProcessController extends AppBaseController
{
    /**
     * Display a listing of the subProcess.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($id, $id2, $id3, Request $request)
    {
        if($request->ajax()){
            /** @var subProcess $subProcesses */
            $subProcesses = subProcess::where('parent_process_id','=',$id3)->get();
            return DataTables::of($subProcesses)
            ->addColumn('company_id',function($process){
                return $process->processMap->company_id;
            })
            ->addColumn('action','sub_processes.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('sub_processes.index')->with('company_id',$id)->with('process_map_id',$id2)->with('process_id',$id3);
    }

    /**
     * Show the form for creating a new subProcess.
     *
     * @return Response
     */
    public function create($id, $id2, $id3)
    {
        return view('sub_processes.create')->with('company_id',$id)->with('process_map_id',$id2)->with('process_id',$id3);
    }

    /**
     * Store a newly created subProcess in storage.
     *
     * @param CreatesubProcessRequest $request
     *
     * @return Response
     */
    public function store($id, $id2, $id3, CreatesubProcessRequest $request)
    {
        $input = $request->all();

        /** @var subProcess $subProcess */
        $subProcess = subProcess::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/subProcesses.singular')]));

        return redirect(route('subProcesses.index',[$id, $id2, $id3]));
    }

    /**
     * Display the specified subProcess.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, $id2, $id3, $id4)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id4);

        if (empty($subProcess)) {
            Flash::error(__('models/subProcesses.singular').' '.__('messages.not_found'));

            return redirect(route('subProcesses.index',[$id, $id2, $id3]));
        }

        return view('sub_processes.show')->with('subProcess', $subProcess)->with('company_id',$id)->with('process_map_id',$id2)->with('process_id',$id3);
    }

    /**
     * Show the form for editing the specified subProcess.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $id2, $id3, $id4)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id4);

        if (empty($subProcess)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subProcesses.singular')]));

            return redirect(route('subProcesses.index',[$id, $id2, $id3]));
        }

        return view('sub_processes.edit')->with('subProcess', $subProcess)->with('company_id',$id)->with('process_map_id',$id2)->with('process_id',$id3);
    }

    /**
     * Update the specified subProcess in storage.
     *
     * @param int $id
     * @param UpdatesubProcessRequest $request
     *
     * @return Response
     */
    public function update($id, $id2, $id3, $id4, UpdatesubProcessRequest $request)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id4);

        if (empty($subProcess)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subProcesses.singular')]));

            return redirect(route('subProcesses.index',[$id, $id2, $id3]));
        }

        $subProcess->fill($request->all());
        $subProcess->save();

        Flash::success(__('messages.updated', ['model' => __('models/subProcesses.singular')]));

        return redirect(route('subProcesses.index',[$id, $id2, $id3]));
    }

    /**
     * Remove the specified subProcess from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $id2, $id3, $id4)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id4);

        if (empty($subProcess)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subProcesses.singular')]));

            return redirect(route('subProcesses.index',[$id, $id2, $id3]));
        }

        $subProcess->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/subProcesses.singular')]));

        return redirect(route('subProcesses.index',[$id, $id2, $id3]))->with('company_id',$id)->with('process_map_id',$id2)->with('process_id',$id3);
    }
}
