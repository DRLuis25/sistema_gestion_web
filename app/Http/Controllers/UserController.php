<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Company;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Response;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            /** @var User $users */
            $users = User::with('roles')->get();
            return DataTables::of($users)
            ->addColumn('rol',function($user){
                return implode(" ",$user->getRoleNames()->toArray());
            })
            ->addColumn('action','users.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('users.index');
        //return implode(" ",$users[0]->getRoleNames()->toArray());
        /*return view('users.index')
            ->with('users', $users);*/
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all()->pluck('name','id');
        $roles = Role::all()->pluck('name', 'name');
        return view('users.create',compact('roles','companies'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        //return $request;
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        /** @var User $user */
        $user = User::create($input);
        $user->syncRoles($request->role);
        Flash::success(__('messages.saved', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('models/users.singular').' '.__('messages.not_found'));

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $companies = Company::all()->pluck('name','id');
        $roles = Role::all()->pluck('name', 'name');

        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('users.index'));
        }

        return view('users.edit',compact('roles','companies'))->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('users.index'));
        }
        if ($request['password']) {
            $request['password'] = Hash::make($request['password']);
        }
        else {
            unset($request['password']);
        }
        $user->syncRoles($request->role);
        $user->fill($request->all());
        $user->save();

        Flash::success(__('messages.updated', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('users.index'));
        }

        $user->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }
}
