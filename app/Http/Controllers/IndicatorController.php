<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIndicatorRequest;
use App\Http\Requests\UpdateIndicatorRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Indicator;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class IndicatorController extends AppBaseController
{
    /**
     * Display a listing of the Indicator.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var Indicator $indicators */
            $indicators = Indicator::all();
            return DataTables::of($indicators)
            ->addColumn('action','indicators.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('indicators.index');
    }

    /**
     * Show the form for creating a new Indicator.
     *
     * @return Response
     */
    public function create()
    {
        return view('indicators.create');
    }

    /**
     * Store a newly created Indicator in storage.
     *
     * @param CreateIndicatorRequest $request
     *
     * @return Response
     */
    public function store(CreateIndicatorRequest $request)
    {
        $input = $request->all();

        /** @var Indicator $indicator */
        $indicator = Indicator::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/indicators.singular')]));

        return redirect(route('indicators.index'));
    }

    /**
     * Display the specified Indicator.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Indicator $indicator */
        $indicator = Indicator::find($id);

        if (empty($indicator)) {
            Flash::error(__('models/indicators.singular').' '.__('messages.not_found'));

            return redirect(route('indicators.index'));
        }

        return view('indicators.show')->with('indicator', $indicator);
    }

    /**
     * Show the form for editing the specified Indicator.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Indicator $indicator */
        $indicator = Indicator::find($id);

        if (empty($indicator)) {
            Flash::error(__('messages.not_found', ['model' => __('models/indicators.singular')]));

            return redirect(route('indicators.index'));
        }

        return view('indicators.edit')->with('indicator', $indicator);
    }

    /**
     * Update the specified Indicator in storage.
     *
     * @param int $id
     * @param UpdateIndicatorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIndicatorRequest $request)
    {
        /** @var Indicator $indicator */
        $indicator = Indicator::find($id);

        if (empty($indicator)) {
            Flash::error(__('messages.not_found', ['model' => __('models/indicators.singular')]));

            return redirect(route('indicators.index'));
        }

        $indicator->fill($request->all());
        $indicator->save();

        Flash::success(__('messages.updated', ['model' => __('models/indicators.singular')]));

        return redirect(route('indicators.index'));
    }

    /**
     * Remove the specified Indicator from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Indicator $indicator */
        $indicator = Indicator::find($id);

        if (empty($indicator)) {
            Flash::error(__('messages.not_found', ['model' => __('models/indicators.singular')]));

            return redirect(route('indicators.index'));
        }

        $indicator->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/indicators.singular')]));

        return redirect(route('indicators.index'));
    }
}
