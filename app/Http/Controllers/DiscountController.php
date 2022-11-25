<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $discounts = Discount::orderBy('name', 'asc')->get();
            $data = array('discounts' => $discounts);
            return view('admin.discounts.discounts_list')->with($data);   
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new Discount();
            $newData->name = $request->input('name');
            $newData->code = $request->input('code');
            $newData->percentage = $request->input('percentage');
            $newData->note = $request->input('note');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result){
                return redirect()->route('discount.index')->with('message', 'İndiirm Başarıyla Kaydedildi!');
            }
            else {
                return response(false, 500);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getDiscount($id)
    {
        try {
            $discount = Discount::where('id', '=', $id)->first();

            return response()->json([$discount], 200);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $discount = Discount::where('id','=', $id)->first();
            return view('admin.discounts.edit_discount', ['discount' => $discount]);
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
            $temp['code'] = $request->input('code');
            $temp['percentage'] = $request->input('percentage');
            $temp['note'] = $request->input('note');

            if (Discount::where('id', '=', $id)->update($temp)) {
                return redirect()->route('discount.index')->with('message', 'İndirim Başarıyla Güncellendi!');
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
        Discount::where('id', '=', $id)->delete();
        return redirect()->route('discount.index')->with('message', 'İndirim Başarıyla Silindi!');
    }
}
