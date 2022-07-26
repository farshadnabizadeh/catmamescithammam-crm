<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="robots" content="noindex">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta http-equiv="X-UA-Compatible" content="IE=7">
      <title>Catma Mescit Hammam | Download Reservation Summary</title>
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link type="text/css" href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
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
                        <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
                        <div class="card p-4 mt-3">
                            <div class="card-title">
                                <h2>Rezervasyon Özetini İndir</h2>
                                <a href="{{ url('/definitions/reservations/create') }}" class="btn btn-primary float-right new-btn">Yeni Rezervasyon <i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown"><img class="flag-img" src="{{ asset('assets/img/flags/it.png') }}"> İtalyanca <span class="caret"></span></button>
                                                    <ul class="dropdown-menu language-dropdown">
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=en') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/en.png') }}"> İngilizce</a></li>
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=de') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/de.png') }}"> Almanca</a></li>
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=fr') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/fr.png') }}"> Fransızca</a></li>
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=es') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/es.png') }}"> İspanyolca</a></li>
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=ru') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/ru.png') }}"> Rusça</a></li>
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=en') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/pl.png') }}"> Lehçe</a></li>
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=pt') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/pt.png') }}"> Portekizce</a></li>
                                                        <li><a href="{{ url('/definitions/reservations/download/'.$reservation->id.'?lang=ar') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/flags/ar.png') }}"> Arapça</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-primary float-right" onclick="voucherPdf();"><i class="fa fa-download"></i> PDF İndir</button>
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
                                                                    <img class="logo_page2" src="{{ asset('assets/img/catmamescitlogosiyah.png') }}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 patientInfo">
                                                                    <h2 class="patient-information-title">CUSTOMER<br> INFORMATION</h2>
                                                                    <br>
                                                                    <p><span>Name, Surname:</span><br> <b id="patient-name-pdf">{{ $reservation->customer->customer_name_surname }}</b></p>
                                                                    <p><span>Phone Number:</span><br> <b>{{ $reservation->customer->customer_phone }}</b></p>
                                                                    <p><span>Country:</span><br> <b>{{ $reservation->customer->customer_country }}</b></p>
                                                                    {{-- <p>Gender: <b>{{ $reservation->patient->gender }}</b></p> --}}
                                                                    <br>
                                                                    <br>
                                                                    <h2 class="contact-title">CONTACT</h2>
                                                                    <br>
                                                                    <p><span>Contact Name:</span><br> <b>Enes</b></p>
                                                                    <p><span>Phone: </span><br> <b>+90 542 619 05 86</b></p>
                                                                    <br>
                                                                </div>
                                                                <div class="col-9 bg-white">
                                                                    <h1 class="treatment-plan-title">RESERVATION SUMMARY</h1>
                                                                    <p class="treatment-name">
                                                                    </p>
                                                                    <table class="table table-bordered treatmentplan-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Care:</th>
                                                                                <th>Piece</th>
                                                                                <th>Price</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($reservation->subServices as $subService)
                                                                            <tr>
                                                                                <td class="text-center">
                                                                                    {{ $subService->service_name }}
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <span class="nights-text">{{ $subService->piece }}</span>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ $subService->service_cost * $subService->piece }} {{ $subService->service_currency }}
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="d-flex flex-row justify-content-end divTotalStatus">
                                                                        <div class="totalStatus">Total Status:</div>
                                                                        <div class="box"><p class="total-cost">{{ $reservation->service_cost }} {{ $reservation->service_currency }}</p></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-center changes text-white">
                                                                            <p class="thicker"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row section-service-photos">
                                                                        <div class="col-12" style="margin-bottom: 20px;">
                                                                            <h2 class="titlePhotos">PHOTOS</h2>
                                                                            <div class="subTitle">Your Hammam</div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="img-cover">
                                                                                <img src="{{ asset('assets/img/gallery/1.jpg') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6" style="padding-left: 0; padding-right: 0">
                                                                            <div class="img-cover">
                                                                                <img src="{{ asset('assets/img/gallery/2.jpg') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 mt-2">
                                                                            <div class="img-cover">
                                                                                <img src="{{ asset('assets/img/gallery/3.jpg') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 mt-2" style="padding-left: 0; padding-right: 0">
                                                                            <div class="img-cover">
                                                                                <img src="{{ asset('assets/img/gallery/4.jpg') }}">
                                                                            </div>
                                                                        </div>
                                                                        {{-- <div class="col-6 mt-2">
                                                                            <div class="img-cover">
                                                                                <img src="{{ asset('assets/img/hotel-service-3.jpg') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 mt-2" style="padding-left: 0">
                                                                            <div class="img-cover">
                                                                                <img src="{{ asset('assets/img/hotel-service-4.jpg') }}">
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
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
                                                                    <p style="margin-bottom: 20px">We are here <b> 09:00 / 23:00 </b> to do our best to help you.</p>
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
        <script type="text/javascript" src="{{ asset('assets/js/spectrum.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery-steps.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/extension-btns-custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/clockpicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/daterangepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/rest_api.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/app.js') }}" defer></script>
    </body>
</html>
