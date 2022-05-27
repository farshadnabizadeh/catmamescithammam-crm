<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="robots" content="noindex">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta http-equiv="X-UA-Compatible" content="IE=7">
      <title>Catma Mescit Hammam | Download Reservation Detail</title>
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

        @include('layouts.menu')

        <main class="main-content">
            @include('layouts.navbar')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Previous Page</button>
                        <div class="card p-5 mt-3">
                            <div class="card-title">
                                <h2>Download Treatment Plan</h2>
                                <a href="{{ url('/definitions/treatmentplans/create') }}" class="btn btn-success float-right new-btn">New Treatment Plan</a>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown"><img class="flag-img" src="{{ asset('assets/img/en.png') }}"> English <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/de/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/de.png') }}"> Deutsch</a></li>
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/it/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/it.png') }}"> Italian</a></li>
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/fr/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/fr.png') }}"> French</a></li>
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/es/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/es.png') }}"> Spanish</a></li>
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/ru/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ru.png') }}"> Russian</a></li>
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/pl/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pl.png') }}"> Polish</a></li>
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/pt/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pt.png') }}"> Portuguese</a></li>
                                                        <li><a href="{{ url('/definitions/treatmentplans/download/ar/'.$reservation->id) }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ar.png') }}"> Arabic</a></li>
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
                                                                    <h2 class="patient-information-title">PATIENT<br> INFORMATION</h2>
                                                                    <br>
                                                                    <p><span>Name, Surname:</span> <b id="patient-name-pdf">{{ $reservation->customer->customer_name }}</b></p>
                                                                    <p><span>BMI:</span> <b></b></p>
                                                                    <p><span>Chronic Illnesses:</span> </p>
                                                                    <p><span>Surgical History:</span> </p>
                                                                    <p><span>Allergies:</span> </p>
                                                                    <p><span>Medications:</span> </p>
                                                                    <p><span>Alcohol:</span> <b> </b></p>
                                                                    <p><span>Smoking:</span> <b></b></p>
                                                                    {{-- <p>Gender: <b>{{ $reservation->patient->gender }}</b></p> --}}
                                                                    <br>
                                                                    <br>
                                                                    <h2 class="doctor-notes-title">DOCTOR'S NOTES</h2>
                                                                    <br>
                                                                    <p><span>Doctor Name:</span>
                                                                    </p>
                                                                    <p><span>Surgeon's Recommendation:</span> <b></b></p>
                                                                    <br>
                                                                    <br>
                                                                    <h2 class="contact-title">CONTACT</h2>
                                                                    <br>
                                                                    <p><span>Patient Care Manager:</span> <b></b></p>
                                                                    <p><span>Phone:</span> <b></b></p>
                                                                </div>
                                                                <div class="col-8 bg-white">
                                                                    <h1 class="treatment-plan-title">TREATMENT PLAN</h1>
                                                                    <p class="treatment-name">
                                                                        
                                                                    </p>
                                                                    <table class="table table-bordered treatmentplan-table">
                                                                        <thead>
                                                                            <tr>
                                                                            <th>Price:</th>
                                                                            <th>Duration of Stay</th>
                                                                            <th>Hospitalization</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                            <td class="text-center">
                                                                               
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <span class="nights-text">Nights</span>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <span class="night-text">Night</span>
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
                                                                            <h3 class="titlePrice">Included in the Price</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col includeText">
                                                                            {{-- @if($reservation->treatment_id == 92 || $reservation->treatment_id == 93 || $reservation->treatment_id == 94) --}}
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span>Procedure</span></p>
                                                                            <p style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span>All of the standard pre-operative assessments in hospital before operation(Ultrasound, Xray, Blood Tests, Internal Medicine Doctor Consultation, Anesthesiologist Consultation, Endoscopy, ECG)</span></p>
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> {{ $reservation->hospitalization }} stay in hospital after operation</p>
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span>One year dietician follow up as aftercare service</span></p>
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span>The medications that the surgeon will prescribe after the operation</span></p>
                                                                            <p><i class="fa fa-caret-right iconsFa"></i>
                                                                            <span></span> Nights hotel accommodation including a companion</p>
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span>VIP transportation between hotel, hospital and airport,</span></p>
                                                                            <p style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span>A medical interpreter that speaks your language who will support and assist you with your needs during your stay(English,Spanish,Italian,German,Arabic,Polish,Albanian,Romanian),</span></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col divPrice">
                                                                            <h3 class="titlePrice">Not Included in the Price</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col includeText2">
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span>Charges for extended inpatient hospital stays:</span></p>
                                                                            {{-- <p><i class="fa fa-caret-right iconsFa"></i> <span>The protein shake and large spectrum vitamin supplements</span></p> --}}
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span>Your arrival and departure flights</span></p>
                                                                            <p><i class="fa fa-caret-right iconsFa"></i> <span>Your personal expenses</span></p>
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
                                                                    <h2 class="titlePhotos">PHOTOS</h2>
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
                                                                        <p>If your travel plans change please inform us <b>48 hours</b> prior your arrival date</p>
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