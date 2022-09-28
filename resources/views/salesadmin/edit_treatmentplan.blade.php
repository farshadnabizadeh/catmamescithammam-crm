@extends('layouts.app')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
                <div class="card p-3 mt-3">
                    <div class="container-fluid px-4">
                        <p class="text-white tp-status" style="background-color: {{ $treatment_plan->status->status_color }}">Treatment Plan Status: {{ $treatment_plan->status->status_name }}</p>
                        <nav class="nav nav-borders">
                            <a class="nav-link active ms-0" href="{{ url('/salesadmin/treatmentplan/edit/'.$treatment_plan->id) }}"><i class="fa fa-user"></i> Patient Information</a>
                            <a class="nav-link" href="{{ url('/salesadmin/treatmentplan/edit/'.$treatment_plan->id.'?page=photos') }}"><b>{{ $photosCount }}</b> Photos @if(!$hasPhotos) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                            <a class="nav-link {{ ($treatment_plan->post_time == NULL)? "disabled" : "" }}" href="{{ url('/salesadmin/treatmentplan/edit/'.$treatment_plan->id.'?page=doctor_recommended') }}"><i class="fa fa-user-md"></i> Doctor's Advice</a>
                            @if($treatment_plan->treatment_plan_status_id == 3) <button class="btn btn-success float-right" data-toggle="modal" data-target="#notificationModal"><i class="fa fa-bell"></i> Send Notification to Doctor</button> @endif
                        </nav>
                        <hr class="mt-0 mb-4">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Patient Information</div>
                                    <div class="card-body text-center">
                                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/user.png') }}" alt="">
                                        <div class="small font-italic text-muted patient-name mb-4">{{ $treatment_plan->patient->name_surname . ' / '. $treatment_plan->patient->age }}</div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0 text-left">Note: <b>{{ $treatment_plan->note }}</b></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="card mb-4">
                                    <div class="card-body patient-card-detail">
                                        <div class="row pt-3 pb-3">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0">Name, Surname: <b>{{ $treatment_plan->patient->name_surname }}</b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0">Age: <b>{{ $treatment_plan->patient->age }}</b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0 mt-2">BMI: <b>{{ $treatment_plan->bmiValue }}</b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0 mt-2">Alcohol: <b>{{ $treatment_plan->is_alcohol }}</b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0 mt-2">Smoking: <b>{{ $treatment_plan->is_smoke }}</b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0">Requested Treatment: <b>{{ $treatment_plan->treatment->name_en }}</b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0">Surgical History: <b> @foreach($treatment_plan->surgicalHistory as $item) {{ $item->surgical_history }} - ({{ $item->note }}) / @endforeach </b> </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0">Medications: <b> @foreach($treatment_plan->medications as $item) {{ $item->medication }} - ({{ $item->note }}) / @endforeach </b> </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0">Chronic Illnesses: <b> @foreach($treatment_plan->chronicIllnesses as $item){{ $item->chronic_illnesses }} - ({{ $item->note }}) /@endforeach </b> </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pb-2 pt-2">
                                            <div class="col-12 col-lg-6">
                                                <h4 class="mb-0">Allergies: <b> @foreach($treatment_plan->allergies as $item) {{ $item->allergie }} - ({{ $item->note }}) / @endforeach </b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <button class="btn btn-primary post-treatment-plan" data-toggle="modal" data-target="#postModal">@if($treatment_plan->post_time != NULL) Update @else Post @endif <i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-md"></i> Reply Treatment Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                    <input type="hidden" class="treatment_plan_id" value="{{ $treatment_plan->id }}">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label for="treatmentPlanStatusId">Treatment Plan Status</label>
                                <select class="form-control" id="treatmentPlanStatusId">
                                    @if ($treatment_plan->treatment_plan_status_id != "")
                                        @foreach($treatment_plan_statuses as $treatment_plan_status)
                                            @if($treatment_plan->treatment_plan_status_id == $treatment_plan_status->id)
                                                <option value="{{ $treatment_plan_status->id}}" selected>{{ $treatment_plan_status->status_name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                    @foreach ($treatment_plan_statuses as $treatment_plan_status)
                                        <option value="{{ $treatment_plan_status->id }}">{{ $treatment_plan_status->status_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label for="doctorExplanation">Doctor Explanation</label>
                                <textarea class="form-control" id="doctorExplanation" placeholder="Doctor Explanation" required>{{ $treatment_plan->doctor_explanation }}</textarea>
                            </div>
                        </div>
                         <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label for="recommendedTreatmentId">Recommended Treatment</label>
                                <select class="form-control" id="recommendedTreatmentId">
                                    <option></option>
                                     @if ($treatment_plan->treatment->id != "")
                                        @foreach($treatments as $treatment)
                                            @if($treatment_plan->treatment->id == $treatment->id)
                                            <option value="{{ $treatment->id}}" selected>{{ $treatment->name_en }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="{{ $treatment_plan->recommended_treatment_id }}" selected>{{ $treatment_plan->recommendedTreatment->name_en }}</option>
                                    @endif
                                    @foreach ($treatments as $treatment)
                                        <option value="{{ $treatment->id }}">{{ $treatment->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <p>Is it suitable for the operation?</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_suitable" value="1" id="flexRadioDefault1" @if($treatment_plan->is_suitable == 1){{ "checked" }} @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_suitable" value="0" id="flexRadioDefault2" @if($treatment_plan->is_suitable == 0){{ "checked" }} @endif>
                                    <label class="form-check-label" for="flexRadioDefault2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-right mt-3" id="postTreatmentPlanBtn">Send <i class="fa fa-arrow-right"></i> </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@include('layouts.notification_modal')

@endsection
