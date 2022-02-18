<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $therapists = Therapist::orderBy('therapist_name', 'asc')->get();
            $data = array('therapists' => $therapists);
            return view('admin.therapists.therapists_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newTherapist = new Therapist();
            $newTherapist->therapist_name = $request->input('therapistName');
            $newTherapist->user_id = auth()->user()->id;

            $result = $newTherapist->save();

            if ($result) {
                return redirect('/definitions/therapists')->with('message', 'Therapist Added Successfully!');
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
        $therapist = Therapist::where('id','=',$id)->first();

        return view('admin.therapists.edit_therapist', ['therapist' => $therapist]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $temp['therapist_name'] = $request->input('therapistName');

        if ($updateSelectedData = Therapist::where('id', '=', $id)->update($temp)) {
            return redirect('/definitions/therapists')->with('message', 'Therapist Updated Successfully!');
        }
        else {
            return back()->withInput($request->input());
        }
    }

    public function destroy($id){
        Therapist::find($id)->delete();
        return redirect('definitions/therapists')->with('message', 'Therapist Deleted Successfully!');
    }
}
