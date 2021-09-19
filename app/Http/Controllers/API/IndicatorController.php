<?php

namespace App\Http\Controllers\API;

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

    public function index($id3, $id4, Request $request)
    {
        if($request->ajax()){
            /** @var Indicator $indicators */
            $indicators = Indicator::where('matriz_priorizado_id', $id3)
            ->where('process_id', $id4)
            ->get();
            return DataTables::of($indicators)
            ->addColumn('action','indicators.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store(CreateIndicatorRequest $request)
    {
        $input = $request->all();

        /** @var Indicator $indicator */
        $indicator = Indicator::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/indicators.singular')]));

        return redirect(route('indicators.index'));
    }

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
