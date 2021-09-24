<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIndicatorAPIRequest;
use App\Http\Requests\API\UpdateIndicatorAPIRequest;
use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class IndicatorController
 * @package App\Http\Controllers\API
 */

class IndicatorAPIController extends AppBaseController
{
    /**
     * Display a listing of the Indicator.
     * GET|HEAD /indicators
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Indicator::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $indicators = $query->get();

         return $this->sendResponse(
             $indicators->toArray(),
             __('messages.retrieved', ['model' => __('models/indicators.plural')])
         );
    }

    /**
     * Store a newly created Indicator in storage.
     * POST /indicators
     *
     * @param CreateIndicatorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIndicatorAPIRequest $request)
    {
        $input = $request->all();
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($request);
        try {

            /** @var Indicator $indicator */
            $indicator = Indicator::create($input);
            return Response::json([
                'status'=>'200',
                'e' => $indicator
            ], 200);
        } catch (\Throwable $th) {
            return Response::json([
                'status'=>'500',
                'e'=> $e->getMessage()
            ], 200);
        }


        return $this->sendResponse(
             $indicator->toArray(),
             __('messages.saved', ['model' => __('models/indicators.singular')])
        );
    }

    /**
     * Display the specified Indicator.
     * GET|HEAD /indicators/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Indicator $indicator */
        $indicator = Indicator::find($id);
        $indicator->frecuencia = $indicator->frequency->descripcion;
        $indicator->dataFuentes;
        if (empty($indicator)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/indicators.singular')])
            );
        }

        return $this->sendResponse(
            $indicator->toArray(),
            __('messages.retrieved', ['model' => __('models/indicators.singular')])
        );
    }

    /**
     * Update the specified Indicator in storage.
     * PUT/PATCH /indicators/{id}
     *
     * @param int $id
     * @param UpdateIndicatorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIndicatorAPIRequest $request)
    {
        /** @var Indicator $indicator */
        $indicator = Indicator::find($id);

        if (empty($indicator)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/indicators.singular')])
           );
        }

        $indicator->fill($request->all());
        $indicator->save();

        return $this->sendResponse(
             $indicator->toArray(),
             __('messages.updated', ['model' => __('models/indicators.singular')])
        );
    }

    /**
     * Remove the specified Indicator from storage.
     * DELETE /indicators/{id}
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
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/indicators.singular')])
           );
        }

        $indicator->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/indicators.singular')])
         );
    }
}
