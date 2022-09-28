@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Previous Page</button>
         <div class="card p-0 mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-white tp-status mt-3" style="background-color: {{ $treatment_plan->status->color }}">Treatment Plan Status: {{ $treatment_plan->status->name }}</p>
                </div>
                <div class="col-xl-3">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">User Details</div>
                        <div class="card-body text-center">
                            @if($treatment_plan->patient->gender == "Male")
                            <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/male-patient.png') }}" alt="">
                            @else
                            <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/female-patient.png') }}" alt="">
                            @endif
                            <div class="small font-italic text-muted patient-name mb-4">{{ $treatment_plan->patient->name_surname }} / {{ $treatment_plan->patient->age }}</div>
                            <hr>
                            <div class="row pb-2 pt-2">
                                <div class="col-12 col-lg-21">
                                    <h4 class="mb-0 text-left">Note: <b>{{ $treatment_plan->note }}</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs  d-flex" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="active-tp-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true"><i class="fa fa-user"></i> Patient Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cancel-tp-tab" data-toggle="tab" href="#medical" role="tab" aria-controls="medical" aria-selected="false"><i class="fa fa-history"></i> Medical History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cancel-tp-tab" data-toggle="tab" href="#recommendations" role="tab" aria-controls="recommendations" aria-selected="false"><i class="fa fa-user-md"></i> Doctor's Recommendations</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cancel-tp-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false"><b>{{ $photosCount }}</b> Photos @if(!$hasPhotos) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                                </li>
                            </ul>
                            <form action="{{ route('treatmentplan.update', ['id' => $treatment_plan->id]) }}" method="POST">
                                @csrf
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="active-tp-tab">
                                        <div class="card h-100 mt-3">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="treatmentId">Treatment</label>
                                                                <select class="form-control" name="treatment_id" id="treatmentId">
                                                                    <option value="{{ $treatment_plan->treatment->id }}" @selected(true)>{{ $treatment_plan->treatment->name_en }}</option>
                                                                    @foreach ($treatments as $treatment)
                                                                    <option value="{{ $treatment->id }}">{{ $treatment->name_en }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="salesPersonId">Sales Person</label>
                                                                <select class="form-control" name="sales_person_id" id="salesPersonId">
                                                                    <option value="{{ $treatment_plan->salesPerson->id }}">{{ $treatment_plan->salesPerson->name_surname }}</option>
                                                                    @foreach ($sales_persons as $sales_person)
                                                                    <option value="{{ $sales_person->id }}">{{ $sales_person->name_surname }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="durationOfStay">Duration Of Stay</label>
                                                                <select class="form-control" id="durationOfStay" name="duration_of_stay">
                                                                    <option value="{{ $treatment_plan->duration_of_stay }}" @selected(true)>{{ $treatment_plan->duration_of_stay }}</option>
                                                                    <option value="1 Night">1 Night</option>
                                                                    <option value="2 Nights">2 Nights</option>
                                                                    <option value="3 Nights">3 Nights</option>
                                                                    <option value="4 Nights">4 Nights</option>
                                                                    <option value="5 Nights">5 Nights</option>
                                                                    <option value="6 Nights">6 Nights</option>
                                                                    <option value="7 Nights">7 Nights</option>
                                                                    <option value="8 Nights">8 Nights</option>
                                                                    <option value="9 Nights">9 Nights</option>
                                                                    <option value="10 Nights">10 Nights</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="hospitalization">Hospitalization</label>
                                                                <select class="form-control" id="hospitalization" name="hospitalization" required>
                                                                    <option value="{{ $treatment_plan->hospitalization }}" @selected(true)>{{ $treatment_plan->hospitalization }}</option>
                                                                    <option value="1 Night">1 Night</option>
                                                                    <option value="2 Nights">2 Nights</option>
                                                                    <option value="3 Nights">3 Nights</option>
                                                                    <option value="4 Nights">4 Nights</option>
                                                                    <option value="5 Nights">5 Nights</option>
                                                                    <option value="6 Nights">6 Nights</option>
                                                                    <option value="7 Nights">7 Nights</option>
                                                                    <option value="8 Nights">8 Nights</option>
                                                                    <option value="9 Nights">9 Nights</option>
                                                                    <option value="10 Nights">10 Nights</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="total_price">Estimated Price</label>
                                                                <input type="number" class="form-control" id="total_price" name="total_price" placeholder="Enter Estimated Price" value="{{ $treatment_plan->total_price }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label for="priceCurrency">Currency</label>
                                                                <select class="form-control" name="price_currency" id="priceCurrency">
                                                                    <option value="{{ $treatment_plan->price_currency }}" @selected(true)>{{ $treatment_plan->price_currency }}</option>
                                                                    <option value="€">Euro</option>
                                                                    <option value="$">Dolar</option>
                                                                    <option value="£">Pound</option>
                                                                    <option value="₺">Lira</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="note">Note</label>
                                                                <textarea class="form-control" id="note" name="note" placeholder="Enter Note" rows="3" cols="50">{{ $treatment_plan->note }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="medical" role="tabpanel" aria-labelledby="cancel-tp-tab">
                                        <div class="card h-100 mt-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b>Asthma ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_asthma" id="is_asthma_yes" {{ ($treatment_plan->is_asthma == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_asthma_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_asthma" id="is_asthma_no" {{ ($treatment_plan->is_asthma == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_asthma_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b>Diabetes ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_diabetes" id="is_diabetes_yes" {{ ($treatment_plan->is_diabetes == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_diabetes_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_diabetes" id="is_diabetes_no" {{ ($treatment_plan->is_diabetes == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_diabetes_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b>Hyper Tension ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_hyper_tension" id="is_hyper_tension_yes" {{ ($treatment_plan->is_hyper_tension == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_hyper_tension_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_hyper_tension" id="is_hyper_tension_no" {{ ($treatment_plan->is_hyper_tension == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_hyper_tension_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b> Breathing Problems ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_breathing_problem" id="is_breathing_problem_yes" {{ ($treatment_plan->is_breathing_problem == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_breathing_problem_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_breathing_problem" id="is_breathing_problem_no" {{ ($treatment_plan->is_breathing_problem == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_breathing_problem_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b>Chronic Heart Ilness ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_chronic_illness" id="is_chronic_illness_yes" {{ ($treatment_plan->is_chronic_illness == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_chronic_illness_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_chronic_illness" id="is_chronic_illness_no" {{ ($treatment_plan->is_chronic_illness == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_chronic_illness_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b>HIV ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_hiv" id="is_hiv_yes" {{ ($treatment_plan->is_hiv == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_hiv_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_hiv" id="is_hiv_no" {{ ($treatment_plan->is_hiv == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_hiv_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b> Stroke ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_stroke" id="is_stroke_yes" {{ ($treatment_plan->is_stroke == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_stroke_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_stroke" id="is_stroke_no" {{ ($treatment_plan->is_stroke == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_stroke_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b>Hepatitis ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_hepatitis" id="is_hepatitis_yes" {{ ($treatment_plan->is_hepatitis == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_hepatitis_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_hepatitis" id="is_hepatitis_no" {{ ($treatment_plan->is_hepatitis == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_hepatitis_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label><b>Cancer ?</b></label>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="yes" name="is_cancer" id="is_cancer_yes" {{ ($treatment_plan->is_cancer == "yes")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_cancer_yes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check ml-3">
                                                                        <input class="form-check-input" type="radio" value="no" name="is_cancer" id="is_cancer_no" {{ ($treatment_plan->is_cancer == "no")? "checked" : "" }}>
                                                                        <label class="form-check-label" for="is_cancer_no">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-8">
                                                                        <div class="form-group">
                                                                        <label for="weight"><b>Weight</b></label>
                                                                        <input type="text" class="form-control" id="weight" name="weight" maxlength="3" value="{{ $treatment_plan->weight }}" placeholder="Enter Weight">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                        <label for="weightUnit"><b>Unit</b></label>
                                                                        <select class="form-control" name="weight_unit" id="weightUnit">
                                                                            <option value="{{ $treatment_plan->weight_unit }}" @selected(true)>{{ $treatment_plan->weight_unit }}</option>
                                                                            <option value="Kg">Kg</option>
                                                                            <option value="St">St</option>
                                                                            <option value="lbs">lbs</option>
                                                                        </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-8">
                                                                        <div class="form-group">
                                                                            <label for="height"><b>Height</b></label>
                                                                            <input type="text" class="form-control" name="height" id="height" value="{{ $treatment_plan->height }}" placeholder="Enter Height">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="heightUnit"><b>Unit</b></label>
                                                                            <select class="form-control" name="height_unit" id="heightUnit">
                                                                                <option value="{{ $treatment_plan->height_unit }}" @selected(true)>{{ $treatment_plan->height_unit }}</option>
                                                                                <option value="Cm">Cm</option>
                                                                                <option value="Inch">Inch</option>
                                                                                <option value="Ft">Ft</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="recommendations" role="tabpanel" aria-labelledby="cancel-tp-tab">
                                        <div class="card h-100 mt-3">
                                            <div class="col-12 col-sm-12">
                                                <div class="row pt-3 pb-3">
                                                    <div class="col-12 col-lg-12">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            Recommended Treatment: <b>@if($treatment_plan->recommended_treatment_id == null) - @else {{ $treatment_plan->recommendedTreatment->treatment_name }} @endif</b>
                                                        </li>
                                                        <li class="list-group-item">
                                                            Is it suitable for operation? <b>@if($treatment_plan->is_suitable == null) - @elseif($treatment_plan->is_suitable == 1) Yes @else No  @endif</b>
                                                        </li>
                                                        <li class="list-group-item">
                                                            Doctor Explanation: <b>@if($treatment_plan->doctor_explanation == null) - @else {{ $treatment_plan->doctor_explanation }} @endif </b>
                                                        </li>
                                                    </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="cancel-tp-tab">
                                        <div class="card h-100 mt-3 ">
                                            <div class="card mb-0">
                                                <div class="card-header">
                                                    <p class="font-weight-600">Photos</p>
                                                    <button type="button" class="btn btn-primary float-right add-photo-btn" data-toggle="modal" data-target="#newPhotoModal"><i class="fa fa-plus"></i> Add New Photo</button>
                                                </div>
                                                <div class="card-body patient-card-detail">
                                                    <div class="row pt-3 pb-3">
                                                        <div class="col-12 col-lg-12">
                                                            @foreach($treatment_plan->photos as $data)
                                                            <a href="{{ url('/images/'.$data->path) }}" class="img-gal">
                                                                <img class="patientPhotos" src="{{ asset('/images/'.$data->path) }}">
                                                            </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-5 float-right" id="updateTreatmentPlan">Update <i class="fa fa-check"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('layouts.notification_modal')
@endsection