<?php

namespace App\Http\Controllers;

use App\Models\TreatmentPlanPhoto;
use Illuminate\Http\Request;

class TreatmentPlanPhotosController extends Controller
{
    public function index()
    {
        $files = FileUpload::all();

        return view('files.index', compact('files'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        $image = $request->file('file');
        $FileName = $image->hashName();
        $image->move(public_path('images'), $FileName);

        $imageUpload = new TreatmentPlanPhoto();
        $imageUpload->path = $FileName;
        $imageUpload->treatment_plan_id = $request->input('treatmentPlanId');
        $imageUpload->save();
        return response()->json(['success' => $FileName]);
    }

    public function show(FileUpload $fileUpload)
    {
        //
    }

    public function edit(FileUpload $fileUpload)
    {
        //
    }

    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    public function destroy($id)
    {

        $fileUpload = TreatmentPlanPhoto::find($id);

        $fileUpload->delete();

        return redirect()->back()->with('success', 'File deleted successfully');
    }
}
