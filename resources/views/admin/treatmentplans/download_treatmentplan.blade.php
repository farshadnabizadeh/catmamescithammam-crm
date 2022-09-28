<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="robots" content="noindex">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta http-equiv="X-UA-Compatible" content="IE=7">
      <title>Arpanu Medical TPAS | Download Treatment Plan</title>
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link type="text/css" href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/gijgo.css') }}" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/grid.css') }}" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/jquery-steps.css') }}" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/glightbox.css') }}" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/fullcalendar.min.css') }}" rel="stylesheet">
      <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
   </head>
   <body onload="app();">

      <div id="preloader-active">
         <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text"><img src="{{ asset('assets/img/favicon.png') }}"></div>
            </div>
         </div>
      </div>

      @if(Auth::user()->hasRole('Doctor')) @include('layouts.doctor_menu')
      @else
         @include('layouts.menu')
      @endif
   
      <main class="main-content">
         @include('layouts.navbar')
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12 table-responsive">
                  <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Previous Page</button>
                  <div class="card p-5 mt-3">
                     <div class="card-title">
                        <h2>Download Treatment Plan</h2>
                        @can('create treatmentplan')
                        <a href="{{ url('/treatmentplans/create') }}" class="btn btn-success float-right new-btn">New Treatment Plan</a>
                     </div>
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-header">
                              <div class="row align-items-center">
                                 <div class="col-6">
                                    <button class="btn btn-primary" onclick="$.MultiLanguage('/assets/data/language.json', 'en')"><img class="flag-img" src="{{ asset('assets/img/en.png') }}"> English</button>
                                    <button class="btn btn-primary" onclick="$.MultiLanguage('/assets/data/language.json', 'de')"><img class="flag-img" src="{{ asset('assets/img/de.png') }}"> Deutsch</button>
                                    <button class="btn btn-primary" onclick="$.MultiLanguage('/assets/data/language.json', 'it')"><img class="flag-img" src="{{ asset('assets/img/it.png') }}"> Italian</button>
                                    <button class="btn btn-primary" onclick="$.MultiLanguage('/assets/data/language.json', 'fr')"><img class="flag-img" src="{{ asset('assets/img/fr.png') }}"> French</button>
                                 </div>
                                 <div class="col-6">
                                    <button class="btn btn-primary float-right" onclick="treatmentPlanPdf();"><i class="fa fa-download"></i> Download PDF</button>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body">
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
                                                      <h2 class="patient-information-title" id="patient-information-title"></h2>
                                                      <br>
                                                      <p><span id="patient-name-surname"></span> <b>{{ $treatment_plans->patient->name_surname }}</b></p>
                                                      <p><span id="patient-age"></span> <b> @if($treatment_plans->patient->age == 0 || $treatment_plans->patient->age == "") - @else {{ $treatment_plans->patient->age }} @endif</b></p>
                                                      <p><span id="patient-bmi"></span> <b>{{ $treatment_plans->bmiValue }}</b></p>
                                                      <p><span id="patient-chronic-illness"></span> @foreach($treatment_plans->chronicIllnesses as $item) <b> {{ $item->chronic_illnesses }},  </b> @endforeach</p>
                                                      <p><span id="patient-surgical-history"></span> @foreach($treatment_plans->medicalHistories as $item) <b> {{ $item->medical_history }}, </b> @endforeach</p>
                                                      <p><span id="patient-allergies"></span> @foreach($treatment_plans->allergies as $item) <b> {{ $item->allergie }}, </b> @endforeach</p>
                                                      <p><span id="patient-medications"></span> @foreach($treatment_plans->medications as $item) <b> {{ $item->medication }}, </b> @endforeach</p>
                                                      <p><span id="patient-alcohol"></span> <b>{{ $treatment_plans->is_alcohol }}</b></p>
                                                      <p><span id="patient-smoking"></span> <b>{{ $treatment_plans->is_smoke }}</b></p>
                                                      {{-- <p>Gender: <b>{{ $treatment_plans->patient->gender }}</b></p> --}}
                                                      <br>
                                                      <br>
                                                      <h2 class="doctor-notes-title" id="doctor-title"></h2>
                                                      <br>
                                                      <p><span id="doctor-name"></span> @foreach($treatment_plans->treatments as $data) <b>{{ $data->doctor->name_surname }}</b> @endforeach
                                                      </p>
                                                      <p><span id="doctor-recommended-treatment"></span> <b>{{ $treatment_plans->treatment->treatment_name }}</b></p>
                                                      <br>
                                                      <br>
                                                      <h2 class="contact-title" id="contact-title"></h2>
                                                      <br>
                                                      <p><span id="contact-patient-name"></span> <b>{{ $treatment_plans->salesPerson->name_surname }}</b></p>
                                                      <p><span id="contact-phone"></span> <b>{{ $treatment_plans->salesPerson->phone_number }}</b></p>
                                                   </div>
                                                   <div class="col-8 bg-white">
                                                      <h1 class="treatment-plan-title" id="treatment-plan-title"></h1>
                                                      <p class="treatment-name">
                                                         @foreach($treatment_plans->subTreatmentsPlanTreatments as $subTreatmentsPlanTreatment)
                                                         {{ $subTreatmentsPlanTreatment->treatment_name }}
                                                         @endforeach
                                                      </p>
                                                      <table class="table table-bordered treatmentplan-table">
                                                         <thead>
                                                            <tr>
                                                               <th id="price-title"></th>
                                                               <th id="duration-of-stay"></th>
                                                               <th id="hospitalization-title"></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <tr>
                                                               <td class="text-center">
                                                                  {{ $treatment_plans->price_currency }} {{ $treatment_plans->total_price }}
                                                               </td>
                                                               <td class="text-center">
                                                                  {{ substr($treatment_plans->duration_of_stay, 0, 1) }} <span class="nights-text"></span>
                                                               </td>
                                                               <td class="text-center">
                                                                  @if($treatment_plans->treatment_id == 92 || $treatment_plans->treatment_id == 93 || $treatment_plans->treatment_id == 94)
                                                                  0 <span class="night-text"></span>
                                                                  @else
                                                                  {{ substr($treatment_plans->hospitalization, 0, 1) }} <span class="nights-text"></span>
                                                                  @endif
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                      {{-- <div class="d-flex flex-row justify-content-end divTotalStatus">
                                                         <div class="totalStatus">Total Status</div>
                                                         <div class="box"><p>£ 3500</p></div>
                                                      </div> --}}
                                                      <div class="row">
                                                         <div class="col text-center changes text-white">
                                                            <p class="thicker"></p>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                         <div class="col divPrice">
                                                            <h3 class="titlePrice" id="include-price-title"></h3>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                         <div class="col includeText">
                                                            @if($treatment_plans->treatment_id == 92 || $treatment_plans->treatment_id == 93 || $treatment_plans->treatment_id == 94)
                                                            <p class="d-none"><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plans->treatment->treatment_name }} <span id="procedure-desc"></span></p>
                                                            <p class="d-none" style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-1"></span></p>
                                                            <p class="d-none"><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plans->hospitalization }} stay in hospital after operation</p>
                                                            <p class="d-none"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-3"></span></p>
                                                            <p class="d-none"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-4"></span></p>
                                                            <p class="d-none"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-5"></span></p>
                                                            <p class="d-none"><i class="fa fa-caret-right iconsFa"></i> 
                                                            <span>{{ $durationOfStay = substr($treatment_plans->duration_of_stay, 0, 1) - $hospitalization = substr($treatment_plans->hospitalization, 0, 1) }}</span> Nights hotel accommodation including a companion</p>
                                                            <p class="d-none"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-7"></span></p>
                                                            <p class="d-none" style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-8"></span></p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> Physical examination with the surgeon</p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> Balloon procedure</p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> Pre operative endoscopy</p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> Hospital supervision for an hour after procedure</p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> 4 nights of hotel stay in the center of the city, including breakfast( we also cover for your companions stay)</p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> VIP transportation between hotel,hospital and airport</p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> One year dietician follow up as aftercare service</p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> A medical interpreter that speaks your language who will support and assist you with your needs during your stay (English, Spanish, Italian, German, Arabic, Polish, Albanian, Romanian)</p>
                                                            @else
                                                            <p ><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plans->treatment->treatment_name }} <span id="procedure-desc"></span></p>
                                                            <p  style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-1"></span></p>
                                                            <p ><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plans->hospitalization }} stay in hospital after operation</p>
                                                            <p ><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-3"></span></p>
                                                            <p ><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-4"></span></p>
                                                            <p ><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-5"></span></p>
                                                            <p ><i class="fa fa-caret-right iconsFa"></i> 
                                                            <span>{{ $durationOfStay = substr($treatment_plans->duration_of_stay, 0, 1) - $hospitalization = substr($treatment_plans->hospitalization, 0, 1) }}</span> Nights hotel accommodation including a companion</p>
                                                            <p ><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-7"></span></p>
                                                            <p style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span id="include-price-8"></span></p>
                                                            @endif
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                         <div class="col divPrice">
                                                            <h3 class="titlePrice" id="not-include-title"></h3> 
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                         <div class="col includeText2">
                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span id="not-include-price-1"></span></p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span id="not-include-price-2"></span></p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span id="not-include-price-3"></span></p>
                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span id="not-include-price-4"></span></p>
                                                         </div>
                                                      </div>
                                                      <div class="row" style="margin-top: 10px;">
                                                         <div class="col-12">
                                                            <h3 class="titleBeforeAfter" id="before-after-title"></h3>
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
                                                {{-- <div class="row">
                                                   <div class="col-lg-12 titleTravel">
                                                      <h1>TRAVEL INFORMATION</h1>
                                                   </div>
                                                </div> --}}
                                                <div class="row">
                                                   {{-- <div class="col-lg-12">
                                                      <table class="table tableTravelInfo">
                                                         <tbody class="tableTravel">
                                                            <tr>
                                                               <th class="tableColor" scope="col">FLIGHT – Arrival/Departure (dates, time)</th>
                                                            </tr>
                                                            <tr>
                                                               <th scope="col">Number of Arriving Guests</th>
                                                            </tr>
                                                            <tr>
                                                               <th class="tableColor" scope="col">Number of Arriving Guests</th>
                                                            </tr>
                                                            <tr>
                                                               <th scope="row">Number of Arriving Guests</th>
                                                            </tr>
                                                            <tr>
                                                               <th class="tableColor" scope="col">Accommodation/Length of Stay </th>
                                                            </tr>
                                                            <tr>
                                                               <th scope="col">Translation & Assistance</th>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div> --}}
                                                </div>
                                                <div class="row section-service-photos" style="margin-top: 30px;">
                                                   <div class="col-12" style="margin-bottom: 20px;">
                                                      <h2 class="titlePhotos" id="photos-title"></h2>
                                                      <div class="subTitle" id="your-hotel"></div>
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
                                                      <div class="subTitle" id="your-transportation"></div>
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
                                                      <p id="important-text"></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-12 text-center infoText">
                                                      <p id="important-text-1"></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-12 text-center infoText">
                                                      <p style="margin-bottom: 20px" id="important-text-2"></p>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="container page4 mt-5">
                                          <div class="row">
                                             <div class="newBorder3">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <img class="logo_page4" src="{{ asset('assets/img/arpanu-logo.png') }}">
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col">
                                                      <h2 class="titleFinancials" id="financial-title"></h2>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-12 financialsText">
                                                      <p id="financial-1"></p>
                                                      <p id="financial-2"></p>
                                                      <p id="financial-3"></p>
                                                      <p id="financial-4"></p>
                                                      <p id="financial-5"></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col">
                                                      <h2 class="titleSignature" id="signature-title"></h2>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-12 signatureText">
                                                      <p id="signature-1"></p>
                                                      <p id="signature-2"></p>
                                                      <p id="signature-3"></p>
                                                      <p id="signature-4"></p>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col">
                                                      <h2 class="titlePolicy" id="policy-title"></h2>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-12 policyText">
                                                      <p id="policy-1"></p>
                                                      <p id="policy-2"></p>
                                                      <p id="policy-3"></p>
                                                      <p id="policy-4"></p>
                                                      <p id="policy-5"></p>
                                                   </div>
                                                </div>
                                                <div class="row getInfoRow">
                                                   <div class="col-lg-12 getInfo">
                                                      <p id="get-info"></p>
                                                      <p id="get-info-desc"></p>
                                                      <div class="col getInfoText">
                                                         <p id="get-info-name"></p>
                                                         <p id="get-info-signature"></p>
                                                         <p id="get-info-date"></p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="container page5 mt-5">
                                          <div class="row">
                                             <div class="newBorder4">
                                                <div class="row">
                                                   <div class="col">
                                                      <h2 class="titleGenInfo" id="general-information-title"></h2>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col">
                                                      <p class="genInfoText" id="general-information-desc"></p>
                                                      <p><i class="fa fa-caret-right iconsFa"></i> <span id="general-information-desc-2"></span></p>
                                                      <p><b id="general-information-desc-3"></b> - <a href="http://www.mfa.gov.tr/visa-information-for-foreigners.en.mfa" target="_blank" rel="noopener noreferrer">http://www.mfa.gov.tr/visa-information-for-foreigners.en.mfa</a></p>
                                                      <p><i class="fa fa-caret-right iconsFa"></i> <span id="general-information-desc-4"></span></p>
                                                      <p><i class="fa fa-caret-right iconsFa"></i> <span id="general-information-desc-5"></span></p>
                                                      <div class="emergencies">
                                                         <p><span id="emergencies"></span> +90 530 417 23 38</p>
                                                      </div>
                                                      <div class="row">
                                                         <div class="col-6">
                                                            <img class="genInfoLogoArpanu" src="{{ asset('assets/img/arpanu-logo.png') }}">
                                                         </div>
                                                         <div class="col-6">
                                                            <img class="genInfoLogoCeyhun" src="{{ asset('assets/img/ceyhun-logo.png') }}">
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                         <div class="col-lg-12 footerText">
                                                            <p id="footer-text"></p>
                                                         </div>
                                                         <div class="col-lg-12 footerText">
                                                            <img class="qr-code" src="{{ asset('assets/img/arpanu-medical-qr-code.png') }}">
                                                         </div>
                                                         <div class="col-lg-12 footerContact">
                                                            <p><b id="address-text"></b> Merkez Mah. Abide-i Hürriyet Cad.</p>
                                                            <p>Aykaç Apt. No 171/8, Sisli/Istanbul Turkey</p>
                                                            <p><b id="email-text"></b> contact@arpanumedical.com</p>
                                                            <p>arpanumedical.com</p>
                                                            <p>+90 541 760 10 26</p>
                                                         </div>
                                                         <div class="col-lg-12" style="display: none">
                                                            <a href="https://facebook.com/arpanumedical" target="_blank"><i class="fa fa-facebook-f iconsCircleFacebook"></a></i>
                                                            <a href="https://instagram.com/arpanumedical" target="_blank"><i class="fa fa-instagram iconsCircleInstagram"></a></i>
                                                            <a href="https://whatsapp.com" target="_blank"><i class="fa fa-whatsapp iconsCircleWhatsapp"></a></i>
                                                            <a href="https://tiktok.com" target="_blank"><i class="fa fa-tiktok iconsCircleInstagram"></a></i>
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
            </div>
         </div>
      </main>

      <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/js.cookie.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/chart.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery.scrollbar.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery-scrollLock.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/Chart.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/glightbox.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/Chart.extension.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery.datatable.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/intlTelInput.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/datatable.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery.MultiLanguage.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jscolor.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/jquery-steps.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/extension-btns-custom.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/gijgo.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/daterangepicker.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/rest_api.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/app.js') }}" defer></script>
   </body>
</html>