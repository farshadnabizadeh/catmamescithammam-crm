@extends('layouts.app')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Previous Page</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Download Treatment Plan</h2>
                    @can('create treatment plan')
                    <a href="{{ url('/treatmentplans/create') }}" class="btn btn-primary float-right new-btn">New Treatment Plan <i class="fa fa-arrow-right"></i></a>
                    @endcan
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">
                                            <img class="flag-img" src="{{ asset('assets/img/en.png') }}"> English <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=de&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/de.png') }}"> Deutsch</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=it&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/it.png') }}"> Italian</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=fr&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/fr.png') }}"> French</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=es&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/es.png') }}"> Spanish</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=ru&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ru.png') }}"> Russian</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=pl&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pl.png') }}"> Polish</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=pt&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pt.png') }}"> Portuguese</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=tr&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/tr.png') }}"> Turkish</a></li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$treatment_plan->id.'?lang=ar&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ar.png') }}"> Arabic</a></li>
                                        </ul>
                                        <button class="btn btn-warning action-btn" type="button" data-toggle="modal" data-target="#themeModal"><i class="fa fa-files-o"></i> Theme {{ $theme }}</button>
                                        <button class="btn btn-primary action-btn" type="button" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-square-o"></i> Edit Package Content</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary float-right" onclick="treatmentPlanPdf();"><i class="fa fa-download"></i> Download PDF</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding-top: 0">
                            <div>
                                <div class="treatmentPlanCard">
                                    @if($theme == 1)
                                    <div id="root">
                                        <div class="page page-1 page2 theme-1">
                                            <div class="d-flex logos">
                                                <div>
                                                    <img src="{{ asset('assets/img/arpanu-logo.png') }}">
                                                </div>
                                                <div>
                                                    <img src="{{ asset('assets/img/ceyhun-logo.png') }}">
                                                </div>
                                            </div>
                                            <div class="form-top">
                                                <div class="elements">
                                                    <div>
                                                        <h5>Treatment</h5> <p>  {{ $treatment_plan->recommendedTreatment->treatment_name }}</p>
                                                    </div>
                                                    <div>
                                                        <h5>Duration Of Stay</h5> <p> {{ substr($treatment_plan->duration_of_stay, 0, 1) }} <span class="night-text">Nights</span> </p>
                                                    </div>
                                                    <div>
                                                        <h5>Price</h5> <p> {{ $treatment_plan->price_currency }} {{ $treatment_plan->total_price }}</p>
                                                    </div>
                                                </div>
                                                <div  class="elements">
                                                    <div>
                                                        <h5>Dr. Name</h5> <p> <b>{{ __('Ceyhun Aydogan') }}</b> </p>
                                                    </div>
                                                    <div>
                                                        <h5>Surgeon Recommendation</h5>
                                                    </div>
                                                    <div>
                                                        <p>{{ $treatment_plan->recommendedTreatment->treatment_name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-blue">
                                                <p>PATIENT INFORMATION</p>
                                            </div>
                                            <div class="row patient-info">
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Name  | Surname</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b id="patient-name-pdf">{{ $treatment_plan->patient->name_surname }}</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Age</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>{{ $treatment_plan->patient->age }}</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>BMI</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>{{ $treatment_plan->bmiValue }}</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Chronic illnesses</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>@foreach($treatment_plan->chronicIllnesses as $item) {{ $item->chronic_illnesses }}, @endforeach</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Surgical History</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>@foreach($treatment_plan->surgicalHistory as $item) {{ $item->surgical_history }}, @endforeach</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Allergies</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>@foreach($treatment_plan->allergies as $item) {{ $item->allergie }}, @endforeach</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Medications</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>@foreach($treatment_plan->medications as $item) {{ $item->medication }}, @endforeach</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Alcohol</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>@if($treatment_plan->is_alcohol == "yes") Yes @elseif($treatment_plan->is_alcohol == "no") No @else - @endif</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <div><h4>Smoking</h4></div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p><b>@if($treatment_plan->is_smoke == "yes") Yes @elseif($treatment_plan->is_smoke == "no") No @else - @endif</b></p>
                                                </div>
                                            </div>
                                            <div class="list-logo list-custom">
                                                <div class="list-title">
                                                    <h2>Included in the Price</h2>
                                                </div>
                                                    <ul>
                                                        <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span> <span class="ml-1" data-attr="item-1">Gastric Sleeve Surgery procedure</span></li>
                                                        <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span><span class="ml-1" data-attr="item-2">All of the standard pre-operative assessments in hospital before operation (Ultrasound, Xray, Blood Tests, Internal Medicine Doctor Consultation, Anesthesiologist Consultation, Endoscopy, ECG)</span></li>
                                                        <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span><span class="ml-1" data-attr="item-3">2 Nights stay in hospital after operation</span></li>
                                                        <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span><span class="ml-1" data-attr="item-4">One year dietician follow up as aftercare service</span></li>
                                                        <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span><span class="ml-1" data-attr="item-5">The medications that the surgeon will prescribe after the operation</span></li>
                                                        <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span><span class="ml-1" data-attr="item-6">{{ substr($treatment_plan->duration_of_stay, 0, 1) - substr($treatment_plan->hospitalization, 0, 1) }} Nights Nights hotel accommodation including a companion</span></li>
                                                        <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span><span class="ml-1" data-attr="item-7">A medical interpreter that speaks your language who will support and assist you with your needs during your stay (English,Spanish,Italian,German,Arabic,Polish,Albanian,Romanian),</span></li>
                                                    </ul>
                                            </div>
                                            <div class="list-logo list-custom">
                                                <div class="list-title">
                                                    <h2>Not Included in the Price</h2>
                                                </div>
                                                <ul>
                                                    <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span> <span class="ml-1" data-attr="item-8">Charges for extended inpatient hospital stays:</span></li>
                                                    <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span> <span class="ml-1" data-attr="item-9">Your arrival and departure flights</span></li>
                                                    <li><span><img src="{{ asset('assets/img/list-icon.png') }}" style="max-width: 10px"></span> <span class="ml-1" data-attr="item-10">Your personal expenses</span></li>
                                                </ul>
                                            </div>
                                            <div class="footer">
                                                <div class="contact-infos">
                                                    <h3 class="text-white">CONTACT</h3>
                                                    <div class="d-flex" style="gap: 20px;">
                                                        <div> <strong>Medical Consultant: </strong>  {{ $treatment_plan->salesPerson->name_surname }}</div>
                                                        <div><strong>Phone:</strong> <a href="05455739511" class="text-white">{{ $treatment_plan->salesPerson->phone_number }}</a></div>
                                                        <div> <strong>E-Mail:</strong><a href="mailto:info@arpanumedical.com" class="text-white"> info@arpanumedical.com</a></div>
                                                    </div>
                                                    <div class="social-media">
                                                        <a href="https://www.facebook.com/arpanumedical/">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="30px" height="30px">
                                                                <g id="surface31705126">
                                                                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 15 30 C 6.714844 30 0 23.285156 0 15 C 0 6.714844 6.714844 0 15 0 C 23.285156 0 30 6.714844 30 15 C 30 23.285156 23.285156 30 15 30 Z M 15 30 "/>
                                                                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(9.019608%,21.176471%,37.254903%);fill-opacity:1;" d="M 19.457031 12 L 17.054688 12 L 17.054688 10 C 17.054688 8.96875 17.136719 8.316406 18.617188 8.316406 L 19.484375 8.316406 C 20.035156 8.316406 20.484375 7.871094 20.484375 7.316406 L 20.484375 6.0625 C 20.484375 5.539062 20.082031 5.09375 19.5625 5.058594 C 18.957031 5.019531 18.351562 5 17.746094 5 C 15.035156 5 13.054688 6.65625 13.054688 9.699219 L 13.054688 12 L 11.054688 12 C 10.5 12 10.054688 12.449219 10.054688 13 L 10.054688 15 C 10.054688 15.550781 10.5 16 11.054688 16 L 13.054688 16 L 13.054688 24 C 13.054688 24.550781 13.5 25 14.054688 25 L 16.054688 25 C 16.605469 25 17.054688 24.550781 17.054688 24 L 17.054688 15.996094 L 19.226562 15.996094 C 19.734375 15.996094 20.164062 15.613281 20.222656 15.109375 L 20.449219 13.113281 C 20.519531 12.519531 20.054688 12 19.457031 12 Z M 19.457031 12 "/>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                        <a href="instagram.com/arpanumedical/">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="30px" height="30px">
                                                                <g id="surface31644253">
                                                                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 15 30 C 6.714844 30 0 23.285156 0 15 C 0 6.714844 6.714844 0 15 0 C 23.285156 0 30 6.714844 30 15 C 30 23.285156 23.285156 30 15 30 Z M 15 30 "/>
                                                                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(9.019608%,21.176471%,37.254903%);fill-opacity:1;" d="M 11 5.398438 C 7.910156 5.398438 5.398438 7.914062 5.398438 11 L 5.398438 19 C 5.398438 22.089844 7.914062 24.601562 11 24.601562 L 19 24.601562 C 22.089844 24.601562 24.601562 22.085938 24.601562 19 L 24.601562 11 C 24.601562 7.910156 22.085938 5.398438 19 5.398438 Z M 20.601562 8.601562 C 21.042969 8.601562 21.398438 8.957031 21.398438 9.398438 C 21.398438 9.839844 21.042969 10.199219 20.601562 10.199219 C 20.160156 10.199219 19.800781 9.839844 19.800781 9.398438 C 19.800781 8.957031 20.160156 8.601562 20.601562 8.601562 Z M 15 10.199219 C 17.648438 10.199219 19.800781 12.351562 19.800781 15 C 19.800781 17.648438 17.648438 19.800781 15 19.800781 C 12.351562 19.800781 10.199219 17.648438 10.199219 15 C 10.199219 12.351562 12.351562 10.199219 15 10.199219 Z M 15 11.800781 C 13.234375 11.800781 11.800781 13.234375 11.800781 15 C 11.800781 16.765625 13.234375 18.199219 15 18.199219 C 16.765625 18.199219 18.199219 16.765625 18.199219 15 C 18.199219 13.234375 16.765625 11.800781 15 11.800781 Z M 15 11.800781 "/>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                        @arpanumedical
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="page page-2 page3" size="A4">
                                            <div class="d-flex logos">
                                                <div>
                                                    <img src="{{ asset('assets/img/arpanu-logo.png') }}">
                                                </div>
                                                <div>
                                                    <img src="{{ asset('assets/img/ceyhun-logo.png') }}">
                                                </div>
                                            </div>
                                            <div class="d-grid-3 images-grid">
                                                <div class="over-text">
                                                    <span>YOUR </span><strong>HOTEL</strong>
                                                </div>
                                                <a href="">
                                                    <img src="{{ asset('assets/img/hotel.jpg') }}">
                                                </a>
                                                <a href="">
                                                    <img src="{{ asset('assets/img/hotel-in.jpg') }}">
                                                </a>
                                                <a href="">
                                                    <img src="{{ asset('assets/img/hotel-3.png') }}">
                                                </a>
                                            </div>
                                            <div class="d-grid-3 images-grid">
                                                <div class="over-text">
                                                    <span>YOUR </span><strong>TRANSPORTATION</strong>
                                                </div>
                                                <a href="https://www.novaplazahotels.com/">
                                                    <img src="{{ asset('assets/img/transportation.jpg') }}">
                                                </a>
                                                <a href="https://www.novaplazahotels.com/">
                                                    <img src="{{ asset('assets/img/vip-service-2.jpg') }}">
                                                </a>
                                                <a href="https://www.novaplazahotels.com/">
                                                    <img src="{{ asset('assets/img/vip-service-3.jpg') }}">
                                                </a>
                                            </div>
                                            <div class="d-grid-3 images-grid">
                                                <div class="over-text" style="bottom: -28px;z-index: 99;">
                                                    <span>YOUR </span><strong>SERVICES</strong>
                                                </div>
                                                <a href="https://www.arpanumedical.com/dentistry" class="position-relative">
                                                    <small class="top">Dentistry</small>
                                                    <img src="{{ asset('assets/img/dentistry.jpg') }}">
                                                </a>
                                                <a href="https://www.arpanumedical.com/aesthetics" class="position-relative">
                                                    <small class="top">Plastic Surgery</small>
                                                    <img src="{{ asset('assets/img/plastic-surgery.jpg') }}">
                                                </a>
                                                <a href="https://www.arpanumedical.com/hair-transplant" class="position-relative">
                                                    <small class="top">Hair Transplant</small>
                                                    <img src="{{ asset('assets/img/hair-transplant.jpg') }}">
                                                </a>
                                            </div>
                                            <div class="d-grid-3 images-grid">
                                                <div class="position-relative">
                                                    <small class="bottom">Tour</small>
                                                    <img src="{{ asset('assets/img/tour.jpg') }}">
                                                </div>
                                                <div  class="position-relative">
                                                    <small class="bottom">Historical Hammam</small>
                                                    <a href="https://www.catmamescithamami.com/">
                                                        <img src="{{ asset('assets/img/hamam.jpg') }}">
                                                    </a>
                                                </div>
                                                <div  class="position-relative">
                                                    <small class="bottom">Activities</small>
                                                    <img src="{{ asset('assets/img/activities.jpg') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($theme == 2)
                                    <div id="root">
                                        <div class="treatmentPlanCard">
                                            <div class="card-body">
                                            <div class="container page2">
                                                <div class="row pageRow2">
                                                    <div class="newBorder2">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <img class="logo_page2" src="{{ asset('assets/img/ceyhun-logo.png') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 patientInfo">
                                                                <h2 class="patient-information-title">PATIENT INFORMATION</h2>
                                                                <br>
                                                                <p>
                                                                    <span>Name, Surname:</span>
                                                                    <b id="patient-name-pdf">{{ $treatment_plan->patient->name_surname }}</b>
                                                                </p>
                                                                <p>
                                                                    <span>Age:</span>
                                                                    <b> {{ $treatment_plan->patient->age }}</b>
                                                                </p>
                                                                <p>
                                                                    <span>BMI:</span>
                                                                    <b>{{ $treatment_plan->bmiValue }}</b>
                                                                </p>
                                                                <p>
                                                                    <span>Chronic Illnesses:</span> @foreach($treatment_plan->chronicIllnesses as $item) <b> {{ $item->chronic_illnesses }}, </b> @endforeach
                                                                </p>
                                                                <p>
                                                                    <span>Surgical History:</span> @foreach($treatment_plan->surgicalHistory as $item) <b> {{ $item->surgical_history }}, </b> @endforeach
                                                                </p>
                                                                <p>
                                                                    <span>Allergies:</span> @foreach($treatment_plan->allergies as $item) <b> {{ $item->allergie }}, </b> @endforeach
                                                                </p>
                                                                <p>
                                                                    <span>Medications:</span> @foreach($treatment_plan->medications as $item) <b> {{ $item->medication }}, </b> @endforeach
                                                                </p>
                                                                <p>
                                                                    <span>Alcohol:</span>
                                                                    <b> @if($treatment_plan->is_alcohol == "yes") Yes @elseif($treatment_plan->is_alcohol == "no") No @else - @endif</b>
                                                                </p>
                                                                <p>
                                                                    <span>Smoking:</span>
                                                                    <b> @if($treatment_plan->is_smoke == "yes") Yes @elseif($treatment_plan->is_smoke == "no") No @else - @endif</b>
                                                                </p>
                                                                {{-- 
                                                                <p>Gender: 
                                                                    <b>{{ $treatment_plan->patient->gender }}</b>
                                                                </p>
                                                                --}} <br>
                                                                <br>
                                                                <h2 class="doctor-notes-title">
                                                                    <img src="{{ asset('assets/img/wp-doctor.png') }}" alt=""> DOCTOR'S NOTES
                                                                </h2>
                                                                <br>
                                                                <p>
                                                                    <span>Doctor Name:</span>
                                                                    <b>{{ __('Ceyhun Aydogan') }}</b>
                                                                </p>
                                                                <p>
                                                                    <span>Surgeon's Recommendation:</span>
                                                                    <b>{{ $treatment_plan->recommendedTreatment->treatment_name }}</b>
                                                                </p>
                                                                <br>
                                                                <br>
                                                                <h2 class="contact-title">CONTACT</h2>
                                                                <br>
                                                                <p>
                                                                    <span>Patient Care Manager:</span>
                                                                    <b>{{ $treatment_plan->salesPerson->name_surname }}</b>
                                                                </p>
                                                                <p>
                                                                    <span>Telefon:</span>
                                                                    <b>{{ $treatment_plan->salesPerson->phone_number }}</b>
                                                                </p>
                                                                <p>
                                                                    <span>E-Mail:</span>
                                                                    <b>info@arpanumedical.com</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-8 bg-white">
                                                                <h1 class="treatment-plan-title">TREATMENT PLAN</h1>
                                                                <table class="table table-bordered treatmentplan-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Treatment</th>
                                                                            <th>Price</th>
                                                                            <th>Duration Of Stay</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-center">
                                                                                {{ $treatment_plan->recommendedTreatment->treatment_name }}
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{ $treatment_plan->price_currency }} {{ $treatment_plan->total_price }}
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{ substr($treatment_plan->duration_of_stay, 0, 1) }} Nights
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="row">
                                                                    <div class="col text-center changes text-white">
                                                                        <p class="thicker"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col divPrice">
                                                                        <h3 class="titlePrice">Not Included in the Price</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col includeText">
                                                                        {{-- @if($treatment_plan->treatment_id == 92 || $treatment_plan->treatment_id == 93 || $treatment_plan->treatment_id == 94) --}}
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i> <span data-attr="item-1">{{ $treatment_plan->recommendedTreatment->treatment_name }}</span>
                                                                        </p>
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i> <span data-attr="item-2">{{ substr($treatment_plan->hospitalization, 0, 1) }} Nights stay in hospital after operation</span>
                                                                        </p>
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i>
                                                                            <span data-attr="item-3">All of the standard pre-operative assessments in hospital before operation(Ultrasound, Xray, Blood Tests, Internal Medicine Doctor Consultation, Anesthesiologist Consultation, Endoscopy)</span>
                                                                        </p>
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i>
                                                                            <span data-attr="item-4">One year dietician follow up as aftercare service</span>
                                                                        </p>
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i>
                                                                            <span data-attr="item-5">The medications that the surgeon will prescribe after the operation</span>
                                                                        </p>
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i>
                                                                            <span data-attr="item-6">{{ substr($treatment_plan->duration_of_stay, 0, 1) }} Nights hotel accommodation including a companion</span>
                                                                        </p>
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i>
                                                                            <span data-attr="item-7">VIP transportation between hotel, hospital and airport,</span>
                                                                        </p>
                                                                        <p style="line-height: 15px">
                                                                            <i class="fa fa-caret-right iconsFa"></i>
                                                                            <span data-attr="item-8">A medical interpreter that speaks your language who will support and assist you with your needs during your stay(English,Spanish,Italian,German,Arabic,Polish,Albanian,Romanian),</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col divPrice">
                                                                        <h3 class="titlePrice">Not Included in the Price</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col includeText2">
                                                                        <p>
                                                                            <i class="fa fa-caret-right iconsFa"></i>
                                                                            <span data-attr="item-9">Charges for extended inpatient hospital stays:</span>
                                                                        </p>
                                                                        {{--
                                                                        <p>
                                                                        <i class="fa fa-caret-right iconsFa"></i>
                                                                        <span>Eiweißshake und Vitaminpräparate mit breitem Spektrum</span>
                                                                        </p>
                                                                        --}}
                                                                        <p>
                                                                        <i class="fa fa-caret-right iconsFa"></i>
                                                                        <span data-attr="item-10">Your arrival and departure flights</span>
                                                                        </p>
                                                                        <p>
                                                                        <i class="fa fa-caret-right iconsFa"></i>
                                                                        <span data-attr="item-11">Your personal expenses</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 10px;">
                                                                    <div class="col-12">
                                                                        <h3 class="titleBeforeAfter">BEFORE - AFTER</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6" style="padding-right: 0">
                                                                        <div class="img-cover">
                                                                            <img src="{{ asset('assets/img/gallery-1.jpg') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6" style="padding-left: 0">
                                                                        <div class="img-cover">
                                                                            <img src="{{ asset('assets/img/gallery-2.jpg') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container page3">
                                                <div class="row">
                                                    <div class="newBorder3">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <img class="logo_page3_1" src="{{ asset('assets/img/ceyhun-logo.png') }}">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <img class="logo_page3_2" src="{{ asset('assets/img/arpanu-logo.png') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row section-service-photos" style="margin-top: 30px;">
                                                            <div class="col-12" style="margin-bottom: 20px;">
                                                                <div class="subTitle">Your Hotel</div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="img-cover">
                                                                    <img src="{{ asset('assets/img/hotel-service-1.jpg') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6" style="padding-left: 0">
                                                                <div class="img-cover">
                                                                    <img src="{{ asset('assets/img/hotel-service-2.jpg') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mt-3">
                                                                <div class="img-cover">
                                                                    <img src="{{ asset('assets/img/hotel-service-3.jpg') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mt-3" style="padding-left: 0">
                                                                <div class="img-cover">
                                                                    <img src="{{ asset('assets/img/hotel-service-4.jpg') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12" style="margin-bottom: 20px; margin-top: 20px;">
                                                                <div class="subTitle">Your Transportation</div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="img-cover">
                                                                    <img src="{{ asset('assets/img/vip-service-1.jpg') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="img-cover">
                                                                    <img src="{{ asset('assets/img/vip-service-2.jpg') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="img-cover">
                                                                    <img src="{{ asset('assets/img/vip-service-3.jpg') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 text-center importantText">
                                                                <p>IMPORTANT</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 text-center infoText">
                                                                <p>If your travel plans <b> hange please inform us 48 hours </b> prior your arrival date. </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 text-center infoText">
                                                                <p style="margin-bottom: 20px">We are here <b> 24/7 </b> to do our best to help you.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('layouts.edit_treatmentplan_modal')

@include('layouts.theme_modal')

@endsection
