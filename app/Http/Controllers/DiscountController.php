<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

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
            return view('admin.discount.discount_list')->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request){
        try {
            $newData = new Discount();
            $newData->name = $request->input('name');
            $newData->amount = $request->input('amount');
            $newData->percentage = $request->input('percentage');
            $newData->note = $request->input('note');
            $newData->user_id = auth()->user()->id;
            $result = $newData->save();

            if ($result) {
                return redirect()->route('discount.index')->with('message', 'New Discount Added Successfully!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $discount = Discount::where('id','=',$id)->first();

            return view('admin.discount.edit_discount', ['discount' => $discount]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name'] = $request->input('name');
            $temp['amount'] = $request->input('amount');
            $temp['percentage'] = $request->input('percentage');
            $temp['note'] = $request->input('note');

            if (Discount::where('id', '=', $id)->update($temp)) {
                return redirect()->route('discount.index')->with('message', 'Discount Updated Successfully!');
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
            Discount::find($id)->delete();
            return redirect()->route('discount.index')->with('message', 'Discount Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
