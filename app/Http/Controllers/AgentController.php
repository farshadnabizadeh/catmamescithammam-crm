<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $agents = Agent::all();
            $data = array('agents' => $agents);
            return view('admin.agents.agents_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Agent();
            $newData->name = $request->input('name');
            $newData->phone = $request->input('phone');
            $newData->country = $request->input('country');
            $newData->city = $request->input('city');
            $newData->address = $request->input('address');
            $newData->email = $request->input('email');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('agent.index')->with('message', 'New Agent Added Successfully!');
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $agents = Agent::where('id', '=', $id)->first();

            return view('admin.agents.edit_agent', ['agent' => $agent]);
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
            $temp['phone'] = $request->input('phone');
            $temp['country'] = $request->input('country');
            $temp['city'] = $request->input('city');
            $temp['address'] = $request->input('address');
            $temp['email'] = $request->input('email');

            if (Agent::where('id', '=', $id)->update($temp)) {
                return redirect()->route('agent.index')->with('message', 'Agent Updated Successfully!');
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
        try {
            Agent::find($id)->delete();
            return redirect()->route('agent.index')->with('message', 'Agent Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
