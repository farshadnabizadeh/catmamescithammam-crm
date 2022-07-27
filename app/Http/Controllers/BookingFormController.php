<?php

namespace App\Http\Controllers;

use App\Models\BookingForm;
use App\Models\FormStatuses;
use App\Models\User;
use Auth;
use Carbon\Carbon;
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
                $data = BookingForm::with('status')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        return '
                        <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="'.url()->current().'/edit/'.$item->id.'" class="btn btn-success text-white edit-btn"><i class="fa fa-check"></i> Durum</a>
                                    </li>
                                </ul>
                            </div>
                        ';
                    })
                    ->editColumn('id', function ($item) {
                        $action = date('ymd', strtotime($item->created_at)) . $item->id;
                        return $action;
                    })
                    ->editColumn('status.status_name', function ($item) {
                        if($item->form_status_id != NULL){
                            return '<span class="badge text-white" style="background-color: '.$item->status->status_color.'">'.$item->status->status_name.'</span>';
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
                    ->rawColumns(['action', 'id', 'status.status_name', 'reservation_date', 'created_at'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status.status_name', 'name' => 'status.status_name', 'title' => 'Durum'],
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

    public function edit($id)
    {
        try {
            $booking_form = BookingForm::where('id','=',$id)->first();
            $form_statuses = FormStatuses::all();
            return view('admin.bookingforms.edit_booking', ['booking_form' => $booking_form, 'form_statuses' => $form_statuses]);
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
                return redirect('/definitions/contactforms')->with('message', 'Rezervasyon Formu Başarıyla Güncellendi!');
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
            $temp['form_status_id'] = $request->input('formStatusId');
            $temp['answered_time'] = Carbon::now()->toDateTimeString();

            if (BookingForm::where('id', '=', $id)->update($temp)) {
                return redirect('definitions/bookings')->with('message', 'Form Durumu Başarıyla Güncellendi!');
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
            return redirect('definitions/contactforms')->with('message', 'Rezervasyon Formu Başarıyla Silindi!');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
