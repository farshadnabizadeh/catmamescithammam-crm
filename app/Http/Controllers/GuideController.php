<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
class GuideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $guides = Guide::orderBy('name', 'asc')->get();
            $data = array('guides' => $guides);
            return view('admin.guides.guides_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getGuides()
    {
        try {
            $guides = Guide::all();

            $output = [];
            foreach ($guides as $guide) {
                $output[$guide->id] = $guide->name;
            }

            return json_encode($output);

        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Guide();
            $newData->name = $request->input('name');
            $newData->phone = $request->input('phone');
            $newData->iban = $request->input('iban');
            $newData->note = $request->input('note');

            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result){
                return redirect()->route('guide.index')->with('message', 'Rehber Başarıyla Kaydedildi!');
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
            $guide = Guide::where('id','=',$id)->first();

            return view('admin.guides.edit_guide', ['guide' => $guide]);
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
            $temp['iban'] = $request->input('iban');
            $temp['note'] = $request->input('note');

            if (Guide::where('id', '=', $id)->update($temp)) {
                return redirect()->route('guide.index')->with('message', 'Rehber Başarıyla Güncellendi!');
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
        Guide::where('id', '=', $id)->delete();
        return redirect()->route('guide.index')->with('message', 'Rehber Başarıyla Silindi!');
    }
}
