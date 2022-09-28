@extends('layouts.app')
@section('content')
@include('layouts.navbar')

    <div class="container-fluid doctor-screen">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
                <div class="card p-3 mt-3">
                    <div class="container-fluid">
                        <p class="text-white tp-status" style="background-color: {{ $treatment_plan->status->color }}">Tedavi Planı Durumu: {{ $treatment_plan->status->name }}</p>
                        <nav class="nav nav-borders" id="myTab" role="tablist">
                            <a class="nav-link active ms-0" id="active-tp-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true"><i class="fa fa-user"></i> Hasta Detayları</a>
                            <a class="nav-link" id="cancel-tp-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="true"><b>{{ $photosCount }}</b> Fotoğraf @if(!$hasPhotos) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                            <a class="nav-link" id="cancel-tp-tab" data-toggle="tab" href="#doctor" role="tab" aria-controls="doctor" aria-selected="true"><i class="fa fa-user-md"></i> Doktor Önerileri</a>
                        </nav>
                        <hr class="mt-0 mb-4">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="active-tp-tab">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header"><b>Hasta Detayları</b></div>
                                            <div class="card-body text-center">
                                                @if($treatment_plan->patient->gender == "Male")
                                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/male-patient.png') }}" alt="">
                                                @else
                                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/female-patient.png') }}" alt="">
                                                @endif
                                                <div class="small font-italic text-muted patient-name mb-4">{{ $treatment_plan->patient->name_surname }} / {{ $treatment_plan->patient->age }}</div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0 text-left">Not: <b>{{ $treatment_plan->note }}</b></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9">
                                        <div class="card mb-4">
                                            <div class="card-body patient-card-detail">
                                                <div class="row pt-3 pb-3">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Adı, Soyadı: <b>{{ $treatment_plan->patient->name_surname }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Yaş: <b>{{ $treatment_plan->patient->age }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Kilo: <b>{{ $treatment_plan->weight . ' ' . $treatment_plan->weight_unit }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Boy: <b>{{ $treatment_plan->height . ' ' . $treatment_plan->height_unit }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0 mt-2"><i class="fa fa-arrow-right"></i> Astım'ı var mı: <b>{{ $treatment_plan->is_asthma }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0 mt-2"><i class="fa fa-arrow-right"></i> Diyabet: <b>{{ $treatment_plan->is_diabetes }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Solunum Problemleri: <b>{{ $treatment_plan->is_breathing_problem }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Kronik Kalp Hastalığı: <b>{{ $treatment_plan->is_chronic_illness }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> HIV: <b>{{ $treatment_plan->is_hiv }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Felç: <b>{{ $treatment_plan->is_stroke }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Hepatit mi: <b>{{ $treatment_plan->is_hepatitis }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Kanser: <b>{{ $treatment_plan->is_cancer }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Orak Hücre / Özellik: <b>{{ $treatment_plan->is_sickle }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Anemi: <b>{{ $treatment_plan->is_anaemia }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Böbrek Sorunları: <b>{{ $treatment_plan->is_kidney_problem }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Sigara: <b>{{ $treatment_plan->is_smoking }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Alkol: <b>{{ $treatment_plan->is_alcohol }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Alerji: <b>{{ $treatment_plan->is_allergie }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> Ameliyat Geçmişi: <b>{{ $treatment_plan->is_surgery_history }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0"><i class="fa fa-arrow-right"></i> En son Covid Aşısı ne zaman yapıldı?: <b>{{ $treatment_plan->is_covid_vaccine }}</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="cancel-tp-tab">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header"><b>Hasta Detayları</b></div>
                                            <div class="card-body text-center">
                                                @if($treatment_plan->patient->gender == "Male")
                                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/male-patient.png') }}" alt="">
                                                @else
                                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/female-patient.png') }}" alt="">
                                                @endif
                                                <div class="small font-italic text-muted patient-name mb-4">{{ $treatment_plan->patient->name_surname }} / {{ $treatment_plan->patient->age }}</div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0 text-left">Not: <b>{{ $treatment_plan->note }}</b></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-12 col-12 col-sm-12">
                                        <div class="card mb-4">
                                            <div class="card-header"><b>Fotoğraflar</b></div>
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
                            <div class="tab-pane fade" id="doctor" role="tabpanel" aria-labelledby="cancel-tp-tab">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header"><b>Hasta Detayları</b></div>
                                            <div class="card-body text-center">
                                                @if($treatment_plan->patient->gender == "Male")
                                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/male-patient.png') }}" alt="">
                                                @else
                                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/female-patient.png') }}" alt="">
                                                @endif
                                                <div class="small font-italic text-muted patient-name mb-4">{{ $treatment_plan->patient->name_surname }} / {{ $treatment_plan->patient->age }}</div>
                                                <hr>
                                                <div class="row pb-2 pt-2">
                                                    <div class="col-12 col-lg-6">
                                                        <h4 class="mb-0 text-left">Not: <b>{{ $treatment_plan->note }}</b></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-12 col-12 col-sm-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <span><b>Doktor Önerileri</b></span>
                                            </div>
                                            <div class="card-body patient-card-detail">
                                                <div class="row pb-3">
                                                    <div class="col-12 col-lg-12 col-xl-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                Önerilen Tedavi: <b>@if($treatment_plan->recommended_treatment_id == NULL)  @else {{ $treatment_plan->recommendedTreatment->name_en }} @endif</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                Operasyona Uygun mu? <b>@if($treatment_plan->is_suitable == 1) Evet @elseif($treatment_plan->is_suitable == NULL) @else Hayır @endif</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                Doktor Yorumu: <b>{{ $treatment_plan->doctor_explanation }}</b>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary post-treatment-plan" data-toggle="modal" data-target="#postModal">@if($treatment_plan->post_time != NULL) Güncelle @else Cevapla @endif <i class="fa fa-check"></i></button>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-md"></i> Tedavi Planını Cevapla</h5>
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
                                    <label for="treatmentPlanStatusId">Tedavi Planı Durumu</label>
                                    <select class="form-control" id="treatmentPlanStatusId">
                                        <option value="2" selected>Completed</option>
                                        @if ($treatment_plan->treatment_plan_status_id != "")
                                            @foreach($treatment_plan_statuses as $treatment_plan_status)
                                                @if($treatment_plan->treatment_plan_status_id == $treatment_plan_status->id)
                                                    <option value="{{ $treatment_plan_status->id}}" selected>{{ $treatment_plan_status->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        @foreach ($treatment_plan_statuses as $treatment_plan_status)
                                            <option value="{{ $treatment_plan_status->id }}">{{ $treatment_plan_status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="doctorExplanation">Doktor Yorumu</label>
                                    <textarea class="form-control" id="doctorExplanation" placeholder="Doktor Yorumu">{{ $treatment_plan->doctor_explanation }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 recommendedTreatmentSection">
                                <div class="form-group">
                                    <label for="recommendedTreatmentId">Önerilen Tedavi</label>
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
                            <div class="col-lg-12 col-12 suitableSection">
                                <div class="form-group">
                                    <p>Operasyona Uygun mu?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_suitable" value="1" id="flexRadioDefault1" @if($treatment_plan->is_suitable == 1){{ "checked" }} @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">Evet</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_suitable" value="0" id="flexRadioDefault2" @if($treatment_plan->is_suitable == 0){{ "checked" }} @endif>
                                        <label class="form-check-label" for="flexRadioDefault2">Hayır</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <button type="button" class="btn btn-primary float-right mt-3" id="postTreatmentPlanBtn">Gönder <i class="fa fa-arrow-right"></i> </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

@endsection
