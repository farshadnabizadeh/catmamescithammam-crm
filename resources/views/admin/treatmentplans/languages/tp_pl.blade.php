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
               <a href="{{ url('/definitions/treatmentplans/create') }}" class="btn btn-primary float-right new-btn">New Treatment Plan <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <div class="row align-items-center">
                        <div class="col-6">
                           <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown"><img class="flag-img" src="{{ asset('assets/img/pl.png') }}"> Polish <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=en&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/en.png') }}"> English</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=de&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/de.png') }}"> Deutsch</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=it&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/it.png') }}"> Italian</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=fr&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/fr.png') }}"> French</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=ru&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ru.png') }}"> Russian</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=pt&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pt.png') }}"> Portuguese</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=tr&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/tr.png') }}"> Turkish </a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=ar&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ar.png') }}"> Arabic</a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-6">
                           <button class="btn btn-primary float-right" onclick="treatmentPlanPdf();"><i class="fa fa-download"></i> Download PDF</button>
                        </div>
                     </div>
                  </div>
                  <div class="card-body" style="padding-top: 0">
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
                                             <h2 class="patient-information-title">INFORMACJE O<br> PACJENCIE</h2>
                                             <br>
                                             <p><span>Imię i nazwisko:</span> <b id="patient-name-pdf">{{ $treatment_plan->patient->name_surname }}</b></p>
                                             <p><span>Wiek:</span> <b>{{ $treatment_plan->patient->age }}</b></p>
                                             <p><span>BMI:</span> <b>{{ $treatment_plan->bmiValue }}</b></p>
                                             <p><span>Chroniczne dolegliwości:</span> @foreach($treatment_plan->chronicIllnesses as $item) <b> {{ $item->chronic_illnesses }},  </b> @endforeach</p>
                                             <p><span>Przebyte operacje:</span> @foreach($treatment_plan->surgicalHistory as $item) <b> {{ $item->surgical_history }}, </b> @endforeach</p>
                                             <p><span>Alergie:</span> @foreach($treatment_plan->allergies as $item) <b> {{ $item->allergie }}, </b> @endforeach</p>
                                             <p><span>Leki:</span> @foreach($treatment_plan->medications as $item) <b> {{ $item->medication }}, </b> @endforeach</p>
                                             <p><span>Alkohol:</span> <b> @if($treatment_plan->is_alcohol == "yes") Tak @elseif($treatment_plan->is_alcohol == "no") Nie @else - @endif</b></p>
                                             <p><span>Papierosy:</span> <b> @if($treatment_plan->is_smoke == "yes") Tak @elseif($treatment_plan->is_smoke == "no") Nie @else - @endif</b></p>
                                             {{-- 
                                             <p>Gender: <b>{{ $treatment_plan->patient->gender }}</b></p>
                                             --}}
                                             <br>
                                             <br>
                                             <h2 class="doctor-notes-title"><img src="{{ asset('assets/img/wp-doctor.png') }}" alt="">  UWAGI LEKARZA</h2>
                                             <br>
                                             <p><span>Imię i nazwisko lekarza:</span><b>{{ __('Ceyhun Aydogan') }}</b></p>
                                             <p><span>Zalecenie chirurga:</span> <b>{{ $treatment_plan->recommendedTreatment->treatment_name_pl }}</b></p>
                                             <br>
                                             <br>
                                             <h2 class="contact-title">KONTAKT</h2>
                                             <br>
                                             <p><span>Kierownik Opieki nad Pacjentami:</span> <b>{{ $treatment_plan->salesPerson->name_surname }}</b></p>
                                             <p><span>Telefon:</span> <b>{{ $treatment_plan->salesPerson->phone_number }}</b></p>
                                             <p><span>E-mail:</span> <b>info@arpanumedical.com</b></p>
                                          </div>
                                          <div class="col-8 bg-white">
                                             <h1 class="treatment-plan-title">PLAN LECZENIA</h1>
                                             <p class="treatment-name">
                                             </p>
                                             <table class="table table-bordered treatmentplan-table">
                                                <thead>
                                                   <tr>
                                                      <th>Leczenıa:</th>
                                                      <th>Szacunkowa cena:</th>
                                                      <th>Czas pobytu</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                      <td class="text-center">
                                                         {{ $treatment_plan->recommendedTreatment->treatment_name_pl }}
                                                      </td>
                                                      <td class="text-center">
                                                         {{ $treatment_plan->price_currency }} {{ $treatment_plan->total_price }}
                                                      </td>
                                                      <td class="text-center">
                                                         {{ substr($treatment_plan->duration_of_stay, 0, 1) }} <span class="nights-text">Nights</span>
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
                                                   <h3 class="titlePrice">Included in the Price</h3>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col includeText">
                                                   {{-- @if($treatment_plan->treatment_id == 92 || $treatment_plan->treatment_id == 93 || $treatment_plan->treatment_id == 94) --}}
                                                   <p><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plan->recommendedTreatment->treatment_name_pl }}<span>Procedure</span></p>
                                                   <p style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span>Wszystkie standardowe badania przedoperacyjne w szpitalu przed operacją (USG, RTG, badania krwi, konsultacja lekarza chorób wewnętrznych, konsultacja anestezjologa, endoskopia, ECG)</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plan->hospitalization }} stay in hospital after operation</p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Roczna obserwacja dietetyka jako usługa pooperacyjna</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Wszystkie leki stosowane podczas operacji i pobytu w szpitalu</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i>
                                                      <span>{{ $treatment_plan->duration_of_stay }}</span> Nights hotel accommodation including a companion
                                                   </p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Transport VIP między hotelem, szpitalem i lotniskiem</span></p>
                                                   <p style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span>Tłumacz medyczny, który mówi w Twoim języku, wesprze Cię i pomoże podczas pobytu (angielski, hiszpański, włoski, niemiecki, arabski, polski, albański, rumuński)</span></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col divPrice">
                                                   <h3 class="titlePrice">Nie wliczone w cenę</h3>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col includeText2">
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Opłaty za przedłużony pobyt w szpitalu stacjonarnym:</span></p>
                                                   {{-- 
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Koktajl proteinowy i suplementy witaminowe o szerokim spektrum</span></p>
                                                   --}}
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Twoje przyloty i odloty</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Twoje osobiste wydatki</span></p>
                                                </div>
                                             </div>
                                             <div class="row" style="margin-top: 10px;">
                                                <div class="col-12">
                                                   <h3 class="titleBeforeAfter">PRZED I PO</h3>
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
                                             <div class="subTitle">Twój hotel</div>
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
                                             <div class="subTitle">Twój transport</div>
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
                                             <p>WAŻNE</p>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 text-center infoText">
                                             <p>Jeśli Twoje plany podróży ulegną zmianie, poinformuj nas o tym na <b>48 godzin</b> przed datą przyjazdu.</p>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 text-center infoText">
                                             <p style="margin-bottom: 20px">Jesteśmy tu <b> 24/7 </b> aby dołożyć wszelkich starań, by Ci pomóc.</p>
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
            </div>
         </div>
      </div>
   </div>
</div>

@include('layouts.theme_modal')

@endsection