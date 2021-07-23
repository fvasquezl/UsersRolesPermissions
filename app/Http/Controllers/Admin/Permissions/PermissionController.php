<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new Permission);

        if ($request->ajax()) {
            $data = Permission::all();

            return DataTables::of($data)
                ->setRowId(function ($permission) {
                    return $permission->id;
                })->addColumn('action', function ($permission) {
                    return view('admin.permissions.partials.buttons', compact('permission'));
                })->rawColumns(['action'])->make(true);
        }

        return view('admin.permissions.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);

        return view('admin.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $data = $request->validate(['display_name' => 'required']);
        $permission->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Permission updated'
        ], 200);

        // return redirect()
        //     ->route('admin.permissions.edit', $permission)
        //     ->with('info', 'El Permiso ha sido actualizado');
    }
}
