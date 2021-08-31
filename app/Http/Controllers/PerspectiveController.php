<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePerspectiveRequest;
use App\Http\Requests\UpdatePerspectiveRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Perspective;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class PerspectiveController extends AppBaseController
{

    /**
     * Display a listing of the Perspective.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var Perspective $perspectives */
            $perspectives = Perspective::all();
            return DataTables::of($perspectives)
            ->addColumn('action','perspectives.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('perspectives.index');
    }

    /**
     * Show the form for creating a new Perspective.
     *
     * @return Response
     */
    public function create()
    {
        return view('perspectives.create');
    }

    /**
     * Store a newly created Perspective in storage.
     *
     * @param CreatePerspectiveRequest $request
     *
     * @return Response
     */
    public function store(CreatePerspectiveRequest $request)
    {
        $input = $request->all();

        /** @var Perspective $perspective */
        $perspective = Perspective::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/perspectives.singular')]));

        return redirect(route('perspectives.index'));
    }

    /**
     * Display the specified Perspective.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Perspective $perspective */
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            Flash::error(__('models/perspectives.singular').' '.__('messages.not_found'));

            return redirect(route('perspectives.index'));
        }

        return view('perspectives.show')->with('perspective', $perspective);
    }

    /**
     * Show the form for editing the specified Perspective.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Perspective $perspective */
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectives.singular')]));

            return redirect(route('perspectives.index'));
        }

        return view('perspectives.edit')->with('perspective', $perspective);
    }

    /**
     * Update the specified Perspective in storage.
     *
     * @param int $id
     * @param UpdatePerspectiveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePerspectiveRequest $request)
    {
        /** @var Perspective $perspective */
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectives.singular')]));

            return redirect(route('perspectives.index'));
        }

        $perspective->fill($request->all());
        $perspective->save();

        Flash::success(__('messages.updated', ['model' => __('models/perspectives.singular')]));

        return redirect(route('perspectives.index'));
    }

    /**
     * Remove the specified Perspective from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Perspective $perspective */
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            Flash::error(__('messages.not_found', ['model' => __('models/perspectives.singular')]));

            return redirect(route('perspectives.index'));
        }

        $perspective->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/perspectives.singular')]));

        return redirect(route('perspectives.index'));
    }

}
