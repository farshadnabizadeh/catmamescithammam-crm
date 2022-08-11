<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $sources = Source::orderBy('source_name', 'asc')->get();
            $data = array('sources' => $sources);
            return view('admin.sources.sources_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Source();
            $newData->source_name = $request->input('sourceName');
            $newData->source_color = $request->input('sourceColor');
            $newData->user_id = auth()->user()->id;

            $result = $newData->save();

            if ($result) {
                return redirect('/definitions/sources')->with('message', 'Rezervasyon Kaynağı Başarıyla Eklendi!');
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
            $source = Source::where('id','=',$id)->first();
            return view('admin.sources.edit_source', ['source' => $source]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['source_name'] = $request->input('sourceName');
            $temp['source_color'] = $request->input('sourceColor');

            if (Source::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/sources')->with('message', 'Rezervasyon Kaynağı Başarıyla Güncellendi!');
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
            Source::where('id', '=', $id)->delete();
            return redirect('definitions/sources')->with('message', 'Rezervasyon Kaynağı Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
