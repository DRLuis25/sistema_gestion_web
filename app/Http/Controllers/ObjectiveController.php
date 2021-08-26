<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateObjectiveRequest;
use App\Http\Requests\UpdateObjectiveRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Objective;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class ObjectiveController extends AppBaseController
{
    /**
     * Display a listing of the Objective.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var Objective $objectives */
            $objectives = Objective::all();
            return DataTables::of($objectives)
            ->addColumn('action','objectives.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('objectives.index');
    }

    /**
     * Show the form for creating a new Objective.
     *
     * @return Response
     */
    public function create()
    {
        return view('objectives.create');
    }

    /**
     * Store a newly created Objective in storage.
     *
     * @param CreateObjectiveRequest $request
     *
     * @return Response
     */
    public function store(CreateObjectiveRequest $request)
    {
        $input = $request->all();

        /** @var Objective $objective */
        $objective = Objective::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/objectives.singular')]));

        return redirect(route('objectives.index'));
    }

    /**
     * Display the specified Objective.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Objective $objective */
        $objective = Objective::find($id);

        if (empty($objective)) {
            Flash::error(__('models/objectives.singular').' '.__('messages.not_found'));

            return redirect(route('objectives.index'));
        }

        return view('objectives.show')->with('objective', $objective);
    }

    /**
     * Show the form for editing the specified Objective.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Objective $objective */
        $objective = Objective::find($id);

        if (empty($objective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/objectives.singular')]));

            return redirect(route('objectives.index'));
        }

        return view('objectives.edit')->with('objective', $objective);
    }

    /**
     * Update the specified Objective in storage.
     *
     * @param int $id
     * @param UpdateObjectiveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateObjectiveRequest $request)
    {
        /** @var Objective $objective */
        $objective = Objective::find($id);

        if (empty($objective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/objectives.singular')]));

            return redirect(route('objectives.index'));
        }

        $objective->fill($request->all());
        $objective->save();

        Flash::success(__('messages.updated', ['model' => __('models/objectives.singular')]));

        return redirect(route('objectives.index'));
    }

    /**
     * Remove the specified Objective from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Objective $objective */
        $objective = Objective::find($id);

        if (empty($objective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/objectives.singular')]));

            return redirect(route('objectives.index'));
        }

        $objective->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/objectives.singular')]));

        return redirect(route('objectives.index'));
    }
}
