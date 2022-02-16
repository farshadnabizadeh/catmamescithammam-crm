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
        $therapists = Therapist::orderBy('therapist_name', 'asc')->get();
        $data = array('therapists' => $therapists);
        return view('admin.therapists.therapists_list')->with($data);
    }

    public function store(Request $request)
    {
        $newTherapist = new Therapist();
        $newTherapist->therapist_name = $request->input('therapistName');
        $newTherapist->therapist_surname = $request->input('therapistSurname');
        $newTherapist->user_id = auth()->user()->id;

        $result = $newTherapist->save();

        if ($result) {
            return redirect('/definitions/therapists')->with('message', 'Therapist Added Successfully!');
        }
        else {
            return response(false, 500);
        }
    }

    public function edit($id)
    {
        $therapist = Therapist::where('id','=',$id)->first();

        return view('admin.therapists.therapists_list', ['therapist' => $therapist]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $temp['name_surname'] = $request->input('patientName');
        $temp['is_cigarette'] = $request->input('is_cigarette');
        $temp['note'] = $request->input('note');

        if ($updateSelectedData = Therapist::where('id', '=', $id)->update($temp)) {
            return redirect('/definitions/patients')->with('message', 'Patient Updated Successfully!');
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
