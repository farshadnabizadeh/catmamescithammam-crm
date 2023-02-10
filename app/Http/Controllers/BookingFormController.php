<?php

namespace App\Http\Controllers;

use App\Models\BookingForm;
use App\Models\FormStatuses;
use App\Models\Country;
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

    public function index(Request $request, Builder $builder)
    {
        try {
            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $noContactCount = BookingForm::where('booking_forms.form_status_id', '=', 1)->count();
            $noCallBackCount = BookingForm::where('booking_forms.form_status_id', '=', 2)->count();
            $contactedCount = BookingForm::where('booking_forms.form_status_id', '=', 3)->count();
            $unknownCount = BookingForm::where('booking_forms.form_status_id', '=', 4)->count();

            $data = array('start' => $start, 'end' => $end, 'noContactCount' => $noContactCount, 'noCallBackCount' => $noCallBackCount, 'contactedCount' => $contactedCount, 'unknownCount' => $unknownCount);
            if (request()->ajax()) {
                $data = BookingForm::with('status')->orderBy('created_at', 'desc')->whereBetween('booking_forms.created_at', [date('Y-m-d', strtotime($start))." 00:00:00", date('Y-m-d', strtotime($end))." 23:59:59"])->get();
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        return '
                        <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="'.route('bookingform.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Güncelle</a>
                                    </li>
                                    <li>
                                        <a href="'.route('bookingform.status', ['id' => $item->id]).'" class="btn btn-success text-white edit-btn"><i class="fa fa-check"></i> Durum</a>
                                    </li>
                                </ul>
                            </div>
                        ';
                    })
                    ->editColumn('id', function ($item) {
                        $action = date('ymd', strtotime($item->created_at)) . $item->id;
                        return $action;
                    })
                    ->editColumn('status.name', function ($item) {
                        if($item->form_status_id != NULL){
                            return '<span class="badge text-white" style="background-color: '.$item->status->color.'">'.$item->status->name.'</span>';
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
                    ->rawColumns(['action', 'id', 'status.name', 'date', 'created_at'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status.name', 'name' => 'status.name', 'title' => 'Durum'],
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
            $countries = Country::where('name','!=', $booking_form->country)->get();
            return view('admin.bookingforms.edit_booking', ['booking_form' => $booking_form, 'countries' => $countries]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function status($id)
    {
        try {
            $booking_form = BookingForm::where('id','=',$id)->first();
            $form_statuses = FormStatuses::all();
            return view('admin.bookingforms.edit_bookingstatus', ['booking_form' => $booking_form, 'form_statuses' => $form_statuses]);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['reservation_date'] = $request->input('reservation_date');
            $temp['reservation_time'] = $request->input('reservation_time');
            $temp['name_surname'] = $request->input('name_surname');
            $temp['phone'] = $request->input('phone');
            $temp['country'] = $request->input('country');
            $temp['massage_package'] = implode(' - ',$request->input('massage_package'));
            $temp['hammam_package'] = implode(' - ',$request->input('hammam_package'));
            $temp['male_pax'] = $request->input('male_pax');
            $temp['female_pax'] = $request->input('female_pax');

            if (BookingForm::where('id', '=', $id)->update($temp)) {
                return redirect()->route('bookingform.index')->with('message', 'Rezervasyon Formu Başarıyla Güncellendi!');
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
                return redirect()->route('bookingform.index')->with('message', 'Form Durumu Başarıyla Güncellendi!');
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
        BookingForm::find($id)->delete();
        return redirect()->route('bookingform.index')->with('message', 'Rezervasyon Formu Başarıyla Silindi!');
    }
}
