<?php

namespace App\Http\Controllers;

use App\Models\BookingForm;
use App\Models\FormStatuses;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
class BookingFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Builder $builder)
    {
        try {
            $form_statuses = FormStatuses::all();

            $data = array('form_statuses' => $form_statuses);
            if (request()->ajax()) {
                $data = BookingForm::orderBy('created_at', 'desc')->get();
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        if($item->status == 1){
                            return '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li></li>
                                </ul>
                            </div>';
                        }
                        else {
                            return '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a data-toggle="modal" data-target="#statusModal" class="btn btn-success text-white edit-btn booking-status-btn" data-id="'.$item->id.'"><i class="fa fa-check"></i> Durum</a>
                                    </li>
                                </ul>
                            </div>';
                        }
                    })
                    ->editColumn('id', function ($item) {
                        $action = date('ymd', strtotime($item->created_at)) . $item->id;
                        return $action;
                    })
                    ->editColumn('status', function ($item) {
                        if($item->status == 1){
                            return '<span class="badge badge-success">İletişime Geçildi</span>';
                        }
                        else {
                            return '<span class="badge badge-danger">İletişime Geçilmedi</span>';
                        }
                    })
                    ->editColumn('reservation_date', function ($item) {
                        $action = date('d-m-Y', strtotime($item->reservation_date));
                        return $action;
                    })
                    ->editColumn('created_at', function ($item) {
                        $action = now()->diffInMinutes($item->created_at);
                        return $action;
                    })
                    ->rawColumns(['action', 'id', 'status', 'reservation_date', 'created_at'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status', 'name' => 'status', 'title' => 'Durum'],
                    ['data' => 'reservation_date', 'name' => 'reservation_date', 'title' => 'Rezervasyon Tarihi'],
                    ['data' => 'reservation_time', 'name' => 'reservation_time', 'title' => 'Rezervasyon Saati'],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Adı Soyadı'],
                    ['data' => 'phone', 'name' => 'phone', 'title' => 'Telefon Numarası'],
                    ['data' => 'country', 'name' => 'country', 'title' => 'Ülkesi'],
                    ['data' => 'massage_package', 'name' => 'massage_package', 'title' => 'Masaj Paketi'],
                    ['data' => 'hammam_package', 'name' => 'hammam_package', 'title' => 'Hamam Paketi'],
                    ['data' => 'male_pax', 'name' => 'male_pax', 'title' => 'Erkek Kişi Sayısı'],
                    ['data' => 'female_pax', 'name' => 'female_pax', 'title' => 'Kadın Kişi Sayısı'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Dakika'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.bookingforms.bookingforms_list', compact('html'))->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new BookingForm();
            $newData->reservation_date = $request->input('reservation_date');
            $newData->reservation_time = $request->input('reservation_time');
            $newData->name_surname = $request->input('name_surname');
            $newData->phone = $request->input('phone');
            $newData->country = $request->input('country');
            $newData->massage_package = $request->input('massage_package');
            $newData->hammam_package = $request->input('hammam_package');
            $newData->male_pax = $request->input('male_pax');
            $newData->female_pax = $request->input('female_pax');
            $result = $newData->save();

            if ($result) {
                return response($newData->id, 200);
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
            $contact_form = BookingForm::where('id','=',$id)->first();
            return view('admin.contactforms.edit_contactform', ['contact_form' => $contact_form]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name_surname'] = $request->input('name_surname');
            $temp['phone_number'] = $request->input('phone');
            $temp['country'] = $request->input('country');
            $temp['email'] = $request->input('email');

            if (BookingForm::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/contactforms')->with('message', 'İletişim Formu Başarıyla Güncellendi!');
            }
            else {
                return back()->withInput($request->input());
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $temp['status'] = $request->input('status');

            if (BookingForm::where('id', '=', $id)->update($temp)) {
                return response(200);
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
            ContactForm::find($id)->delete();
            return redirect('definitions/contactforms')->with('message', 'İletişim Formu Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
