<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprocessFlowDiagramRequest;
use App\Http\Requests\UpdateprocessFlowDiagramRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\processFlowDiagram;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class processFlowDiagramController extends AppBaseController
{
    /**
     * Display a listing of the processFlowDiagram.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var processFlowDiagram $processFlowDiagrams */
            $processFlowDiagrams = processFlowDiagram::all();
            return DataTables::of($processFlowDiagrams)
            ->addColumn('action','process_flow_diagrams.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('process_flow_diagrams.index');
    }

    /**
     * Show the form for creating a new processFlowDiagram.
     *
     * @return Response
     */
    public function create()
    {
        return view('process_flow_diagrams.create');
    }

    /**
     * Store a newly created processFlowDiagram in storage.
     *
     * @param CreateprocessFlowDiagramRequest $request
     *
     * @return Response
     */
    public function store(CreateprocessFlowDiagramRequest $request)
    {
        $input = $request->all();

        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index'));
    }

    /**
     * Display the specified processFlowDiagram.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id);

        if (empty($processFlowDiagram)) {
            Flash::error(__('models/processFlowDiagrams.singular').' '.__('messages.not_found'));

            return redirect(route('processFlowDiagrams.index'));
        }

        return view('process_flow_diagrams.show')->with('processFlowDiagram', $processFlowDiagram);
    }

    /**
     * Show the form for editing the specified processFlowDiagram.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id);

        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index'));
        }

        return view('process_flow_diagrams.edit')->with('processFlowDiagram', $processFlowDiagram);
    }

    /**
     * Update the specified processFlowDiagram in storage.
     *
     * @param int $id
     * @param UpdateprocessFlowDiagramRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprocessFlowDiagramRequest $request)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id);

        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index'));
        }

        $processFlowDiagram->fill($request->all());
        $processFlowDiagram->save();

        Flash::success(__('messages.updated', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index'));
    }

    /**
     * Remove the specified processFlowDiagram from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var processFlowDiagram $processFlowDiagram */
        $processFlowDiagram = processFlowDiagram::find($id);

        if (empty($processFlowDiagram)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processFlowDiagrams.singular')]));

            return redirect(route('processFlowDiagrams.index'));
        }

        $processFlowDiagram->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/processFlowDiagrams.singular')]));

        return redirect(route('processFlowDiagrams.index'));
    }
}
