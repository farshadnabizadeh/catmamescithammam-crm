<?php

namespace App\Http\Controllers;

use App\Models\MedicalForm;
use App\Models\Country;
use Auth;
use Carbon\Carbon;
use Faker\Provider\Medical;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
class MedicalFormController extends Controller
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

            $data = array('start' => $start, 'end' => $end);
            if (request()->ajax()) {
                $data = MedicalForm::orderBy('created_at', 'desc')->whereBetween('medical_forms.created_at', [date('Y-m-d', strtotime($start))." 00:00:00", date('Y-m-d', strtotime($end))." 23:59:59"])->get();
                return DataTables::of($data)
                    ->editColumn('action', function ($item) {
                            return '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="'.route('medicalform.edit', ['id' => $item->id]).'" class="btn btn-info edit-btn"><i class="fa fa-eye"></i> Görüntüle</a>
                                    </li>
                                    <li>
                                        <a href="'.route('medicalform.destroy', ['id' => $item->id]).'" class="btn btn-danger edit-btn"><i class="fa fa-pencil-square-o"></i> Sil</a>
                                    </li>
                                </ul>
                            </div>';
                    })
                    ->editColumn('id', function ($item) {
                        $action = date('ymd', strtotime($item->created_at)) . $item->id;
                        return $action;
                    })
                    ->editColumn('created_at', function ($item) {
                        $action = now()->diffInMinutes($item->created_at) . ' Dakika';
                        return $action;
                    })
                    ->editColumn('signature', function ($item) {
                        // return "<a href='$item->signature' id='image-popup'><img src='$item->signature' alt='Signature' width='150' height='auto'></a>";
                        return "<button id='show-img' data-toggle='modal' data-target='#addHotelComissionModal'><img src='$item->signature' width='150' height='auto'></button>

                        <div id='addHotelComissionModal' class='modal fade' aria-labelledby='my-modalLabel' aria-hidden='true' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' data-dismiss='modal' style='margin: 20% auto;'>
                                <div class='modal-content' >
                                    <div class='modal-body'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                        <img src='$item->signature' class='img-responsive' style='width: 100%;'>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    })


                    ->rawColumns(['action', 'id', 'created_at', 'signature'])

                    ->toJson();
                };
                $columns = [
                    ['data' => 'action', 'name' => 'action', 'title' => 'İşlem', 'orderable' => false, 'searchable' => false],
                    ['data' => 'id', 'name' => 'id', 'title' => 'id'],
                    ['data' => 'name_surname', 'name' => 'name_surname', 'title' => 'Adı Soyadı'],
                    ['data' => 'phone', 'name' => 'phone', 'title' => 'Telefon Numarası'],
                    ['data' => 'country', 'name' => 'country', 'title' => 'Ülkesi'],
                    ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                    ['data' => 'birthday', 'name' => 'birthday', 'title' => 'Birthday'],
                    ['data' => 'gender', 'name' => 'gender', 'title' => 'Gender'],
                    ['data' => 'therapist_gender', 'name' => 'therapist_gender', 'title' => 'Therapist Gender'],
                    ['data' => 'heart_problems', 'name' => 'heart_problems', 'title' => 'Heart Problems'],
                    ['data' => 'blood_pressure', 'name' => 'blood_pressure', 'title' => 'Blood Pressure'],
                    ['data' => 'varicose_veins', 'name' => 'varicose_veins', 'title' => 'Varicose Veins'],
                    ['data' => 'asthma', 'name' => 'asthma', 'title' => 'Asthma'],
                    ['data' => 'vertebral_problem', 'name' => 'vertebral_problem', 'title' => 'Vertebral Problem'],
                    ['data' => 'joint_problems', 'name' => 'joint_problems', 'title' => 'Joint Problems'],
                    ['data' => 'fractures', 'name' => 'fractures', 'title' => 'Fractures'],
                    ['data' => 'skin_allergies', 'name' => 'skin_allergies', 'title' => 'Skin Allergies'],
                    ['data' => 'lodine_allergies', 'name' => 'lodine_allergies', 'title' => 'Lodine Allergies'],
                    ['data' => 'hyperthyroidism', 'name' => 'hyperthyroidism', 'title' => 'Hyperthyroidism'],
                    ['data' => 'diabetes', 'name' => 'diabetes', 'title' => 'Diabetes'],
                    ['data' => 'epilepsy', 'name' => 'epilepsy', 'title' => 'Epilepsy'],
                    ['data' => 'pregnant', 'name' => 'pregnant', 'title' => 'Pregnant'],
                    ['data' => 'back_problems', 'name' => 'back_problems', 'title' => 'Back Problems'],
                    ['data' => 'covid', 'name' => 'covid', 'title' => 'Covid'],
                    ['data' => 'covid_note', 'name' => 'covid_note', 'title' => 'Covid Note'],
                    ['data' => 'surgery', 'name' => 'surgery', 'title' => 'Surgery'],
                    ['data' => 'surgery_note', 'name' => 'surgery_note', 'title' => 'Surgery Note'],
                    ['data' => 'signature', 'name' => 'signature', 'title' => 'Signature'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Sisteme Kayıt'],
                ];
                $html = $builder->columns($columns)->parameters([
                    "pageLength" => 50
                ]);

            return view('admin.medicalforms.medicalforms_list', compact('html'))->with($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        $medical_form = MedicalForm::where('id','=',$id)->first();
        $countries = Country::where('name','!=', $medical_form->country)->get();

        return view('admin.medicalforms.edit_medicalform', ['medical_form' => $medical_form, 'countries' => $countries]);
    }

    public function update(Request $request, $id)
    {
        try {
            $temp['name_surname'] = $request->input('nameSurname');
            $temp['phone'] = $request->input('phone');
            $temp['country'] = $request->input('country');
            $temp['email'] = $request->input('email');

            if (MedicalForm::where('id', '=', $id)->update($temp)) {
                return redirect()->route('medicalform.index')->with('message', 'Medikal Formu Başarıyla Güncellendi!');
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
        MedicalForm::find($id)->delete();
        return redirect()->route('medicalform.index')->with('message', 'Medikal Formu Başarıyla Silindi!');
    }
}
