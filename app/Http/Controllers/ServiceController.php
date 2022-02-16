<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $services = Service::orderBy('service_name', 'asc')->get();
        $data = array('services' => $services);
        return view('admin.services.services_list')->with($data);
    }

    public function store(Request $request)
    {
        $newService = new Service();
        $newService->service_name = $request->input('serviceName');
        $newService->service_currency = $request->input('serviceCurrency');
        $newService->service_cost = $request->input('serviceCost');

        $newService->user_id = auth()->user()->id;
        $result = $newService->save();

        if ($result) {
            return redirect('/definitions/services')->with('message', 'Service Added Successfully!');
        }
        else {
            return response(false, 500);
        }
    }

    public function edit($id)
    {
        $service = Service::where('id','=',$id)->first();

        return view('admin.services.edit_service', ['service' => $service]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $temp['service_name'] = $request->input('serviceName');
        $temp['service_currency'] = $request->input('serviceCurrency');
        $temp['service_cost'] = $request->input('serviceCost');

        if ($updateSelectedData = Service::where('id', '=', $id)->update($temp)) {
            return redirect('/definitions/services')->with('message', 'Service Updated Successfully!');
        }
        else {
            return back()->withInput($request->input());
        }
    }

    public function destroy($id){
        Service::find($id)->delete();
        return redirect('definitions/services')->with('message', 'Service Deleted Successfully!');
    }
}
