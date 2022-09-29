<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $services = Service::orderBy('name', 'asc')->get();
            $data = array('services' => $services);
            return view('admin.services.services_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Service();
            $newData->name = $request->input('name');
            $newData->currency = $request->input('currency');
            $newData->cost = $request->input('cost');

            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('service.index')->with('message', 'Hizmet Başarıyla Eklendi!');
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getService($id)
    {
        try {
            $services = Service::where('id', '=', $id)
            ->first();

            return response()->json([$services], 200);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $service = Service::where('id','=',$id)->first();

            return view('admin.services.edit_service', ['service' => $service]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();

            $temp['name'] = $request->input('name');
            $temp['currency'] = $request->input('currency');
            $temp['cost'] = $request->input('cost');

            if (Service::where('id', '=', $id)->update($temp)) {
                return redirect()->route('service.index')->with('message', 'Hizmet Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        try {
            Service::where('id', '=', $id)->delete();
            return redirect()->route('service.index')->with('message', 'Hizmet Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
