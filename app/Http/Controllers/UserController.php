<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $users = User::with("roles")->get();
            $roles = Role::pluck('name', 'name')->all();

            $data = array('users' => $users, 'roles' => $roles);

            return view('admin.users.users_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        try {
            // $roles = UserRole::all();
            $roles = Role::pluck('name', 'name')->all();
            $data = array('roles' => $roles);
            return view('users.new_user')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new User;
            $newData->name = $request->input('userName');
            $newData->email = $request->input('userEmail');
            $newData->password = bcrypt($request->input('userPassword'));

            if ($newData->save()) {
                $newData->assignRole($request->input('roles'));
                return redirect()->route('user.index')->with('message', 'New Users Added Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();

            return view('users.edit_user', compact('user', 'roles', 'userRole'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $user = User::find($id);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();

            return view('admin.users.edit_user', compact('user', 'roles', 'userRole'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name'] = $request->input('userName');
            $temp['email'] = $request->input('userEmail');

            if ($request->has('userPassword') && !empty($request->input('userPassword'))) {
                $temp['password'] = bcrypt($request->input('userPassword'));
            }

            $updateSelectedData = User::where('id', '=', $id)->first();
            if ($updateSelectedData->update($temp)) {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $updateSelectedData->assignRole($request->input('roles'));
                return redirect()->route('user.index')->with('message', 'Kullanıcı Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        DB::table("users")->where('id', $id)->delete();
        return redirect()->route('user.index')->with('message', 'User Deleted Successfully!');
    }
}
