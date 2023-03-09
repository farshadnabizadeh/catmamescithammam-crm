<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <title>Catma Mescit Hammam CRM</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/app.css?v=1.0') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/jquery-steps.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/fullcalendar-5.11.0.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
</head>
@if(Request::is('home'))
    <body onload="app();" class="bg-primary">
@else
    <body onload="app();">
@endif
    {{-- @include('layouts.navbar') --}}
    @include('layouts.menu')

    <main class="main-content">
        @yield('content')
    </main>

    @if (session('message'))
        <script type="text/javascript">
            swal({ icon: 'success', title: 'Başarılı!', text: '{{ session('message') }}', });
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            swal({ icon: 'error', title: 'Error!', text: '{{ session('error') }}', });
        </script>
    @endif
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/js.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-steps.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.scrollbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-scrollLock.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/glightbox.js') }}"></script>
    <!--script type="text/javascript" src="{{ asset('assets/js/Chart.extension.js') }}"></script-->
    <script type="text/javascript" src="{{ asset('assets/js/fullcalendar-5.11.0.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/clockpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.datatable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/intlTelInput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/spectrum.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jscolor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/extension-btns-custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/xlsx.full.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('assets/js/FileSaver.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js?v=1.0') }}" defer></script>

    <script>
        $('.inline-popups').magnificPopup({
            type: 'inline',
            removalDelay: 100,
            fixedBgPos: true,
            closeBtnInside: true,
            callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = this.st.el.attr('data-effect');
                },

                beforeClose: function() {
                    this.content.addClass('animate__animated animate__zoomInDown');
                },
            },
            type: 'ajax',
            midClick: true
        });
    </script>
    @yield('footer')
</body>
</html>
