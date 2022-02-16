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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with("roles")->get();
        $roles = Role::pluck('name', 'name')->all();

        $data = array('users' => $users, 'roles' => $roles);

        return view('admin.users.users_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = UserRole::all();
        $roles = Role::pluck('name', 'name')->all();
        $data = array('roles' => $roles);
        return view('users.new_user')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newUser = new User;
        $newUser->name = $request->input('userName');
        $newUser->email = $request->input('userEmail');
        $newUser->password = bcrypt($request->input('userPassword'));

        if ($newUser->save()) {
            $newUser->assignRole($request->input('roles'));
            return redirect('definitions/users')->with('message', 'New Users Added Successfully!');
        }
        else {
            return back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


       $user = User::find($id);

        $roles = Role::pluck('name', 'name')->all();

        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit_user', compact('user', 'roles', 'userRole'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $roles = Role::pluck('name', 'name')->all();

        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit_user', compact('user', 'roles', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $temp['name'] = $request->input('userName');
        $temp['email'] = $request->input('userEmail');

        if ($request->has('userPassword') && !empty($request->input('userPassword'))) {
            $temp['password'] = bcrypt($request->input('userPassword'));
        }

        $updateSelectedData = User::where('id', '=', $id)->first();
        if ($updateSelectedData->update($temp)) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $updateSelectedData->assignRole($request->input('roles'));
            return redirect('/definitions/users')->with('message', 'Kullanıcı Başarıyla Güncellendi!');
        }
        else {
            return back()->withInput($request->input());
        }
    }

    public function destroy($id)
    {
        DB::table("users")->where('id', $id)->delete();
        return redirect('definitions/users')->with('message', 'User Deleted Successfully!');
    }
}
