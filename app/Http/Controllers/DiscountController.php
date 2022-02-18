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
            $discounts = Discount::orderBy('discount_name', 'asc')->get();
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
            $newDiscount = new Discount();
            $newDiscount->discount_name = $request->input('discountName');
            $newDiscount->discount_code = $request->input('discountCode');
            $newDiscount->discount_percentage = $request->input('discountPercentage');
            $newDiscount->note = $request->input('discountNote');

            $newDiscount->user_id = auth()->user()->id;
            $result = $newDiscount->save();

            if ($result){
                return redirect('/definitions/discounts')->with('message', 'Discount Added Successfully!');
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
            $discounts = DB::table('discounts')
            ->select('discounts.*')
            ->where('id', '=', $id)
            ->first();

            return response()->json([$discounts], 200);
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

            $temp['discount_name'] = $request->input('discountName');
            $temp['discount_code'] = $request->input('discountCode');
            $temp['discount_percentage'] = $request->input('discountPercentage');
            $temp['note'] = $request->input('discountNote');

            if ($updateSelectedData = Discount::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/discounts')->with('message', 'Discount Updated Successfully!');
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
            $discounts = Discount::where('id', '=', $id)->delete();
            return redirect('definitions/discounts')->with('message', 'Discount Deleted Successfully!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
