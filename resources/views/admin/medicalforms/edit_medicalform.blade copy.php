@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Medikal Form</h3>
                </div>
                <form action="{{ route('medicalform.update', ['id' => $medical_form->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameSurname">Adı Soyadı</label>
                                <input type="text" class="form-control" name="nameSurname" id="nameSurname" value="{{$medical_form->name_surname}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Telefon Numarası</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$medical_form->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{$medical_form->email}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="country">Ülkesı</label>
                                <select name="country" class="form-control" id="country">
                                    <option value="{{ $medical_form->country }}">{{ $medical_form->country }}</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="text" class="form-control" name="birthday" id="birthday" value="{{$medical_form->birthday}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <input type="text" class="form-control" name="gender" id="gender" value="{{$medical_form->gender}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="therapist_gender">Therapist Gender</label>
                                <input type="text" class="form-control" name="therapist_gender" id="therapist_gender" value="{{$medical_form->therapist_gender}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="heart_problems">Heart Problems</label>
                                <input type="text" class="form-control" name="heart_problems" id="heart_problems" value="{{$medical_form->heart_problems}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure</label>
                                <input type="text" class="form-control" name="blood_pressure" id="blood_pressure" value="{{$medical_form->blood_pressure}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="varicose_veins">Varicose Veins</label>
                                <input type="text" class="form-control" name="varicose_veins" id="varicose_veins" value="{{$medical_form->varicose_veins}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="asthma">Asthma</label>
                                <input type="text" class="form-control" name="asthma" id="asthma" value="{{$medical_form->asthma}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="vertebral_problem">Vertebral Problem</label>
                                <input type="text" class="form-control" name="vertebral_problem" id="vertebral_problem" value="{{$medical_form->vertebral_problem}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="joint_problems">Joint Problems</label>
                                <input type="text" class="form-control" name="joint_problems" id="joint_problems" value="{{$medical_form->joint_problems}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="fractures">Fractures</label>
                                <input type="text" class="form-control" name="fractures" id="fractures" value="{{$medical_form->fractures}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="skin_allergies">Skin Allergies</label>
                                <input type="text" class="form-control" name="skin_allergies" id="skin_allergies" value="{{$medical_form->skin_allergies}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lodine_allergies">Lodine Allergies</label>
                                <input type="text" class="form-control" name="lodine_allergies" id="lodine_allergies" value="{{$medical_form->lodine_allergies}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hyperthyroidism">Hyperthyroidism</label>
                                <input type="text" class="form-control" name="hyperthyroidism" id="hyperthyroidism" value="{{$medical_form->hyperthyroidism}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="diabetes">Diabetes</label>
                                <input type="text" class="form-control" name="diabetes" id="diabetes" value="{{$medical_form->diabetes}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="epilepsy">Epilepsy</label>
                                <input type="text" class="form-control" name="epilepsy" id="epilepsy" value="{{$medical_form->epilepsy}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pregnant">Pregnant</label>
                                <input type="text" class="form-control" name="pregnant" id="pregnant" value="{{$medical_form->pregnant}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="back_problems">Back Problems</label>
                                <input type="text" class="form-control" name="back_problems" id="back_problems" value="{{$medical_form->back_problems}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="covid">Covid</label>
                                <input type="text" class="form-control" name="covid" id="covid" value="{{$medical_form->covid}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="covid_note">Covid Note</label>
                                <input type="text" class="form-control" name="covid_note" id="covid_note" value="{{$medical_form->covid_note}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="surgery">Surgery</label>
                                <input type="text" class="form-control" name="surgery" id="surgery" value="{{$medical_form->surgery}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="surgery_note">Surgery Note</label>
                                <input type="text" class="form-control" name="surgery_note" id="surgery_note" value="{{$medical_form->surgery_note}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Signature">Signature</label>
                                <img src="{{$medical_form->signature}}" width="500" alt="">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
