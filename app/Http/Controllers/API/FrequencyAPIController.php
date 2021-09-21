<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFrequencyAPIRequest;
use App\Http\Requests\API\UpdateFrequencyAPIRequest;
use App\Models\Frequency;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FrequencyController
 * @package App\Http\Controllers\API
 */

class FrequencyAPIController extends AppBaseController
{
    /**
     * Display a listing of the Frequency.
     * GET|HEAD /frequencies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Frequency::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $frequencies = $query->get();
        return response()->json($frequencies);
         return $this->sendResponse(
             $frequencies->toArray(),
             __('messages.retrieved', ['model' => __('models/frequencies.plural')])
         );
    }

    /**
     * Store a newly created Frequency in storage.
     * POST /frequencies
     *
     * @param CreateFrequencyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFrequencyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Frequency $frequency */
        $frequency = Frequency::create($input);

        return $this->sendResponse(
             $frequency->toArray(),
             __('messages.saved', ['model' => __('models/frequencies.singular')])
        );
    }

    /**
     * Display the specified Frequency.
     * GET|HEAD /frequencies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Frequency $frequency */
        $frequency = Frequency::find($id);

        if (empty($frequency)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/frequencies.singular')])
            );
        }

        return $this->sendResponse(
            $frequency->toArray(),
            __('messages.retrieved', ['model' => __('models/frequencies.singular')])
        );
    }

    /**
     * Update the specified Frequency in storage.
     * PUT/PATCH /frequencies/{id}
     *
     * @param int $id
     * @param UpdateFrequencyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFrequencyAPIRequest $request)
    {
        /** @var Frequency $frequency */
        $frequency = Frequency::find($id);

        if (empty($frequency)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/frequencies.singular')])
           );
        }

        $frequency->fill($request->all());
        $frequency->save();

        return $this->sendResponse(
             $frequency->toArray(),
             __('messages.updated', ['model' => __('models/frequencies.singular')])
        );
    }

    /**
     * Remove the specified Frequency from storage.
     * DELETE /frequencies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Frequency $frequency */
        $frequency = Frequency::find($id);

        if (empty($frequency)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/frequencies.singular')])
           );
        }

        $frequency->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/frequencies.singular')])
         );
    }
}
