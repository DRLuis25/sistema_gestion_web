<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends AppBaseController
{
    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $roles = Role::all();
        //return $roles;
        if($request->ajax()){
            /** @var Role $roles */
            $roles = Role::all();
            return DataTables::of($roles)
            ->addColumn('permission',function($role){
                return implode(", ",$role->getPermissionNames()->toArray());
            })
            ->addColumn('action','roles.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('roles.index');
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        //return $roles;
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();
        unset($input['permission']);
        /** @var Role $role */
        $role = Role::create($input);
        $role->syncPermissions($request->permission);
        Flash::success(__('messages.saved', ['model' => __('models/roles.singular')]));

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error(__('models/roles.singular').' '.__('messages.not_found'));

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Role $role */
        $role = Role::find($id);
        $permissions = Permission::all();

        if (empty($role)) {
            Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));

            return redirect(route('roles.index'));
        }
        return view('roles.edit',compact('permissions'))->with('role', $role);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $input = $request->all();
        unset($input['permission']);
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));

            return redirect(route('roles.index'));
        }
        $role->permissions()->detach();
        $role->fill($input);
        $role->syncPermissions($request->permission);
        $role->save();

        Flash::success(__('messages.updated', ['model' => __('models/roles.singular')]));

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));

            return redirect(route('roles.index'));
        }

        $role->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/roles.singular')]));

        return redirect(route('roles.index'));
    }
}
