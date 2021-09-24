<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedataFuenteAPIRequest;
use App\Http\Requests\API\UpdatedataFuenteAPIRequest;
use App\Models\dataFuente;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class dataFuenteController
 * @package App\Http\Controllers\API
 */

class dataFuenteAPIController extends AppBaseController
{
    /**
     * Display a listing of the dataFuente.
     * GET|HEAD /dataFuentes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = dataFuente::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $dataFuentes = $query->get();

         return $this->sendResponse(
             $dataFuentes->toArray(),
             __('messages.retrieved', ['model' => __('models/dataFuentes.plural')])
         );
    }

    /**
     * Store a newly created dataFuente in storage.
     * POST /dataFuentes
     *
     * @param CreatedataFuenteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedataFuenteAPIRequest $request)
    {
        $input = $request->all();

        /** @var dataFuente $dataFuente */
        $dataFuente = dataFuente::create($input);

        return $this->sendResponse(
             $dataFuente->toArray(),
             __('messages.saved', ['model' => __('models/dataFuentes.singular')])
        );
    }

    /**
     * Display the specified dataFuente.
     * GET|HEAD /dataFuentes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var dataFuente $dataFuente */
        $dataFuente = dataFuente::find($id);

        if (empty($dataFuente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/dataFuentes.singular')])
            );
        }

        return $this->sendResponse(
            $dataFuente->toArray(),
            __('messages.retrieved', ['model' => __('models/dataFuentes.singular')])
        );
    }

    /**
     * Update the specified dataFuente in storage.
     * PUT/PATCH /dataFuentes/{id}
     *
     * @param int $id
     * @param UpdatedataFuenteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedataFuenteAPIRequest $request)
    {
        /** @var dataFuente $dataFuente */
        $dataFuente = dataFuente::find($id);

        if (empty($dataFuente)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/dataFuentes.singular')])
           );
        }

        $dataFuente->fill($request->all());
        $dataFuente->save();

        return $this->sendResponse(
             $dataFuente->toArray(),
             __('messages.updated', ['model' => __('models/dataFuentes.singular')])
        );
    }

    /**
     * Remove the specified dataFuente from storage.
     * DELETE /dataFuentes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var dataFuente $dataFuente */
        $dataFuente = dataFuente::find($id);

        if (empty($dataFuente)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/dataFuentes.singular')])
           );
        }

        $dataFuente->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/dataFuentes.singular')])
         );
    }
}
