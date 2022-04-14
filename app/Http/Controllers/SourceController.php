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
            $newSource = new Source();
            $newSource->source_name = $request->input('sourceName');
            $newSource->source_color = $request->input('sourceColor');
            $newSource->user_id = auth()->user()->id;

            $result = $newSource->save();

            if ($result) {
                return redirect('/definitions/sources')->with('message', 'Source Added Successfully!');
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

            if ($updateSelectedData = Source::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/sources')->with('message', 'Source Updated Successfully!');
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
            $sources = Source::where('id', '=', $id)->delete();
            return redirect('definitions/sources')->with('message', 'Source Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
