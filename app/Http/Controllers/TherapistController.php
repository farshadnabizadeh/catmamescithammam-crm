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
            $therapists = Therapist::orderBy('name', 'asc')->get();
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
            $newData = new Therapist();
            $newData->name = $request->input('name');
            $newData->user_id = auth()->user()->id;

            $result = $newData->save();

            if ($result) {
                return redirect()->route('therapist.index')->with('message', 'Terapist Başarıyla Eklendi!');
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
            $therapist = Therapist::where('id','=',$id)->first();
            return view('admin.therapists.edit_therapist', ['therapist' => $therapist]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $temp['name'] = $request->input('name');

        if (Therapist::where('id', '=', $id)->update($temp)) {
            return redirect()->route('therapist.index')->with('message', 'Terapist Başarıyla Güncellendi!');
        }
        else {
            return back()->withInput($request->input());
        }
    }

    public function destroy($id){
        try {
            Therapist::find($id)->delete();
            return redirect()->route('therapist.index')->with('message', 'Terapist Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
