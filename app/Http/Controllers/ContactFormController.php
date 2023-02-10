<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\FormStatuses;
use App\Models\Country;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
class ContactFormController extends Controller
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

            $noContactCount = ContactForm::where('form_status_id', '=', 1)->count();
            $noCallBackCount = ContactForm::where('form_status_id', '=', 2)->count();
            $contactedCount = ContactForm::where('form_status_id', '=', 3)->count();
            $unknownCount = ContactForm::where('form_status_id', '=', 4)->count();

            $data = array('start' => $start, 'end' => $end, 'noContactCount' => $noContactCount, 'noCallBackCount' => $noCallBackCount, 'contactedCount' => $contactedCount, 'unknownCount' => $unknownCount);
            if (request()->ajax()) {
                $data = ContactForm::with('status')->orderBy('created_at', 'desc')->whereBetween('contact_forms.created_at', [date('Y-m-d', strtotime($start))." 00:00:00", date('Y-m-d', strtotime($end))." 23:59:59"])->get();
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                            return '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="'.route('contactform.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Güncelle</a>
                                    </li>
                                    <li>
                                        <a href="'.route('contactform.status', ['id' => $item->id]).'" class="btn btn-success text-white edit-btn"><i class="fa fa-check"></i> Durum</a>
                                    </li>
                                </ul>
                            </div>';
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
                    ->editColumn('created_at', function ($item) {
                        $action = now()->diffInMinutes($item->created_at) . ' Dakika';
                        return $action;
                    })
                    ->rawColumns(['action', 'id', 'status.name', 'created_at'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status.name', 'name' => 'status.name', 'title' => 'Durum'],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Adı Soyadı'],
                    ['data' => 'phone', 'name' => 'phone', 'title' => 'Telefon Numarası'],
                    ['data' => 'country', 'name' => 'country', 'title' => 'Ülkesi'],
                    ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Sisteme Kayıt'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.contactforms.contactforms_list', compact('html'))->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        $contact_form = ContactForm::where('id','=',$id)->first();
        $countries = Country::where('name','!=', $contact_form->country)->get();

        return view('admin.contactforms.edit_contactform', ['contact_form' => $contact_form, 'countries' => $countries]);
    }
    public function status($id)
    {
        $contact_form = ContactForm::where('id','=',$id)->first();
        $form_statuses = FormStatuses::all();

        return view('admin.contactforms.edit_contactformstatus', ['contact_form' => $contact_form, 'form_statuses' => $form_statuses]);
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name_surname'] = $request->input('nameSurname');
            $temp['phone'] = $request->input('phone');
            $temp['country'] = $request->input('country');
            $temp['email'] = $request->input('email');

            if (ContactForm::where('id', '=', $id)->update($temp)) {
                return redirect()->route('contactform.index')->with('message', 'İletişim Formu Başarıyla Güncellendi!');
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

            if (ContactForm::where('id', '=', $id)->update($temp)) {
                return redirect()->route('contactform.index')->with('message', 'İletişim Formu Başarıyla Güncellendi!');
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
        ContactForm::find($id)->delete();
        return redirect()->route('contactform.index')->with('message', 'İletişim Formu Başarıyla Silindi!');
    }
}
