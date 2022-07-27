<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\FormStatuses;
use App\Models\User;
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

    public function index(Builder $builder)
    {
        try {
            $form_statuses = FormStatuses::all();

            $data = array('form_statuses' => $form_statuses);
            if (request()->ajax()) {
                $data = ContactForm::with('status')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                            return '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                    <a href="'.url()->current().'/edit/'.$item->id.'" class="btn btn-success text-white edit-btn"><i class="fa fa-check"></i> Durum</a>
                                    </li>
                                </ul>
                            </div>';
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
                    ->editColumn('created_at', function ($item) {
                        $action = now()->diffInMinutes($item->created_at) . ' Dakika';
                        return $action;
                    })
                    ->rawColumns(['action', 'id', 'status.status_name', 'created_at'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status.status_name', 'name' => 'status.status_name', 'title' => 'Durum'],
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
        try {
            $contact_form = ContactForm::where('id','=',$id)->first();
            $form_statuses = FormStatuses::all();

            return view('admin.contactforms.edit_contactform', ['contact_form' => $contact_form, 'form_statuses' => $form_statuses]);
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

            if (ContactForm::where('id', '=', $id)->update($temp)) {
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
            $temp['form_status_id'] = $request->input('formStatusId');
            $temp['answered_time'] = Carbon::now()->toDateTimeString();

            if (ContactForm::where('id', '=', $id)->update($temp)) {
                return redirect('/definitions/contactforms')->with('message', 'Form Durumu Başarıyla Güncellendi!');
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
