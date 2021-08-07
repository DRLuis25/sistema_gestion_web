<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprocessTypeRequest;
use App\Http\Requests\UpdateprocessTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\processType;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class processTypeController extends AppBaseController
{
    /**
     * Display a listing of the processType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var processType $processTypes */
            $processTypes = processType::all();
            return DataTables::of($processTypes)
            ->addColumn('action','process_types.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('process_types.index');
    }

    /**
     * Show the form for creating a new processType.
     *
     * @return Response
     */
    public function create()
    {
        return view('process_types.create');
    }

    /**
     * Store a newly created processType in storage.
     *
     * @param CreateprocessTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateprocessTypeRequest $request)
    {
        $input = $request->all();

        /** @var processType $processType */
        $processType = processType::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/processTypes.singular')]));

        return redirect(route('processTypes.index'));
    }

    /**
     * Display the specified processType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var processType $processType */
        $processType = processType::find($id);

        if (empty($processType)) {
            Flash::error(__('models/processTypes.singular').' '.__('messages.not_found'));

            return redirect(route('processTypes.index'));
        }

        return view('process_types.show')->with('processType', $processType);
    }

    /**
     * Show the form for editing the specified processType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var processType $processType */
        $processType = processType::find($id);

        if (empty($processType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processTypes.singular')]));

            return redirect(route('processTypes.index'));
        }

        return view('process_types.edit')->with('processType', $processType);
    }

    /**
     * Update the specified processType in storage.
     *
     * @param int $id
     * @param UpdateprocessTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprocessTypeRequest $request)
    {
        /** @var processType $processType */
        $processType = processType::find($id);

        if (empty($processType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processTypes.singular')]));

            return redirect(route('processTypes.index'));
        }

        $processType->fill($request->all());
        $processType->save();

        Flash::success(__('messages.updated', ['model' => __('models/processTypes.singular')]));

        return redirect(route('processTypes.index'));
    }

    /**
     * Remove the specified processType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var processType $processType */
        $processType = processType::find($id);

        if (empty($processType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/processTypes.singular')]));

            return redirect(route('processTypes.index'));
        }

        $processType->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/processTypes.singular')]));

        return redirect(route('processTypes.index'));
    }
}
