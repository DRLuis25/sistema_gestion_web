<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesubProcessRequest;
use App\Http\Requests\UpdatesubProcessRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Process;
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
        $process = Process::find($id3);
        if($request->ajax()){
            /** @var subProcess $subProcesses */
            $subProcesses = subProcess::where('parent_process_id','=',$id3);
            return DataTables::of($subProcesses)
            ->addColumn('action','sub_processes.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('sub_processes.index');
    }

    /**
     * Show the form for creating a new subProcess.
     *
     * @return Response
     */
    public function create()
    {
        return view('sub_processes.create');
    }

    /**
     * Store a newly created subProcess in storage.
     *
     * @param CreatesubProcessRequest $request
     *
     * @return Response
     */
    public function store(CreatesubProcessRequest $request)
    {
        $input = $request->all();

        /** @var subProcess $subProcess */
        $subProcess = subProcess::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/subProcesses.singular')]));

        return redirect(route('subProcesses.index'));
    }

    /**
     * Display the specified subProcess.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id);

        if (empty($subProcess)) {
            Flash::error(__('models/subProcesses.singular').' '.__('messages.not_found'));

            return redirect(route('subProcesses.index'));
        }

        return view('sub_processes.show')->with('subProcess', $subProcess);
    }

    /**
     * Show the form for editing the specified subProcess.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id);

        if (empty($subProcess)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subProcesses.singular')]));

            return redirect(route('subProcesses.index'));
        }

        return view('sub_processes.edit')->with('subProcess', $subProcess);
    }

    /**
     * Update the specified subProcess in storage.
     *
     * @param int $id
     * @param UpdatesubProcessRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesubProcessRequest $request)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id);

        if (empty($subProcess)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subProcesses.singular')]));

            return redirect(route('subProcesses.index'));
        }

        $subProcess->fill($request->all());
        $subProcess->save();

        Flash::success(__('messages.updated', ['model' => __('models/subProcesses.singular')]));

        return redirect(route('subProcesses.index'));
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
    public function destroy($id)
    {
        /** @var subProcess $subProcess */
        $subProcess = subProcess::find($id);

        if (empty($subProcess)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subProcesses.singular')]));

            return redirect(route('subProcesses.index'));
        }

        $subProcess->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/subProcesses.singular')]));

        return redirect(route('subProcesses.index'));
    }
}
