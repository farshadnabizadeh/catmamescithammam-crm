<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $roles = Role::all();

            return view('admin.rolepermissions.roles_list', compact('roles'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        try {
            $permissions = Permission::get();
            return view('admin.rolepermissions.new_role', compact('permissions'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);

            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            return redirect('roles')->with('message', 'Yeni Rol Başarıyla Eklendi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function cloneRole($id)
    {
        try {
            $role = Role::find($id);
            $permissions = Permission::get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();

            $cloneRole = Role::create(['name' => $role->name . ' CLONE']);
            $cloneRole->syncPermissions($rolePermissions);

            $newrId = $cloneRole->id;

            $role = Role::find($newrId);
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $newrId)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();

            return view('rolepermissions.edit_role', compact('role', 'permissions', 'rolePermissions'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $role = Role::find($id);
            $permissions = Permission::get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();

            return view('admin.rolepermissions.edit_role', compact('role', 'permissions', 'rolePermissions'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect('roles')->with('message', 'Rol Başarıyla Güncellendi!');
    }

    public function destroy($id)
    {
        try {
            DB::table("roles")->where('id', $id)->delete();
            return redirect('roles')->with('message', 'Rol Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
