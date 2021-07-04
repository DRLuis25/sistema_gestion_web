<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuditRequest;
use App\Http\Requests\UpdateAuditRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Audit;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class AuditController extends AppBaseController
{
    /**
     * Display a listing of the Audit.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var Audit $audits */
            $audits = Audit::all();
            return DataTables::of($audits)
            ->addColumn('action','audits.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('audits.index');
    }

    /**
     * Show the form for creating a new Audit.
     *
     * @return Response
     */
    public function create()
    {
        return view('audits.create');
    }

    /**
     * Store a newly created Audit in storage.
     *
     * @param CreateAuditRequest $request
     *
     * @return Response
     */
    public function store(CreateAuditRequest $request)
    {
        $input = $request->all();

        /** @var Audit $audit */
        $audit = Audit::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/audits.singular')]));

        return redirect(route('audits.index'));
    }

    /**
     * Display the specified Audit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Audit $audit */
        $audit = Audit::find($id);

        if (empty($audit)) {
            Flash::error(__('models/audits.singular').' '.__('messages.not_found'));

            return redirect(route('audits.index'));
        }

        return view('audits.show')->with('audit', $audit);
    }

    /**
     * Show the form for editing the specified Audit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Audit $audit */
        $audit = Audit::find($id);

        if (empty($audit)) {
            Flash::error(__('messages.not_found', ['model' => __('models/audits.singular')]));

            return redirect(route('audits.index'));
        }

        return view('audits.edit')->with('audit', $audit);
    }

    /**
     * Update the specified Audit in storage.
     *
     * @param int $id
     * @param UpdateAuditRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuditRequest $request)
    {
        /** @var Audit $audit */
        $audit = Audit::find($id);

        if (empty($audit)) {
            Flash::error(__('messages.not_found', ['model' => __('models/audits.singular')]));

            return redirect(route('audits.index'));
        }

        $audit->fill($request->all());
        $audit->save();

        Flash::success(__('messages.updated', ['model' => __('models/audits.singular')]));

        return redirect(route('audits.index'));
    }

    /**
     * Remove the specified Audit from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Audit $audit */
        $audit = Audit::find($id);

        if (empty($audit)) {
            Flash::error(__('messages.not_found', ['model' => __('models/audits.singular')]));

            return redirect(route('audits.index'));
        }

        $audit->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/audits.singular')]));

        return redirect(route('audits.index'));
    }
}
