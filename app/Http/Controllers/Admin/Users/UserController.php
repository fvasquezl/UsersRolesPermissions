<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->authorize('view', new User);

        if ($request->ajax()) {
            $data = User::allowed()->get();

            return DataTables::of($data)
                ->setRowId(function ($user) {
                    return $user->id;
                })->editColumn('roles', function ($user) {
                    return $user->getRoleNames()->implode(', ');
                })->addColumn('created_at', function ($user) {
                    return $user->created_at->toFormattedDateString();
                })->addColumn('action', function ($user) {
                    return view('admin.users.partials.buttons', compact('user'));
                })->rawColumns(['action'])->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;

        $this->authorize('create', $user);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view(
            'admin.users.create',
            compact('user', 'roles', 'permissions')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\User\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create', new User);

        $request->createUser();

        return response()->json([
            'success' => true,
            'message' => 'User created'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view(
            'admin.users.edit',
            compact('user', 'roles', 'permissions')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\User\UserRequest  $request
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $request->updateUser($user);

        return response()->json([
            'success' => true,
            'message' => 'User updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
