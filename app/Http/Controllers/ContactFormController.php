<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\User;
use Auth;
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
            if (request()->ajax()) {
                $data = ContactForm::with('formStatus')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                        if($item->status == 1){
                            return '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        
                                    </li>
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
                        return '<span class="badge text-white" style="background-color: '. $item->formStatus->status_color .'">'. $item->formStatus->status_name .'</span>';
                    })
                    ->editColumn('created_at', function ($item) {
                        $action = now()->diffInMinutes($item->created_at) . ' Dakika';
                        return $action;
                    })
                    ->rawColumns(['action', 'id', 'status', 'created_at'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'status', 'name' => 'status', 'title' => 'Durum'],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Adı Soyadı'],
                    ['data' => 'phone', 'name' => 'phone', 'title' => 'Telefon Numarası'],
                    ['data' => 'country', 'name' => 'country', 'title' => 'Ülkesi'],
                    ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Sisteme Kayıt'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.contactforms.contactforms_list', compact('html'));
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $newData = new ContactForm();
            $newData->name_surname = $request->input('name_surname');
            $newData->phone = $request->input('phone');
            $newData->country = $request->input('country');
            $newData->email = $request->input('email');
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
            $contact_form = ContactForm::where('id','=',$id)->first();
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
            $temp['status'] = $request->input('status');

            if (ContactForm::where('id', '=', $id)->update($temp)) {
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
