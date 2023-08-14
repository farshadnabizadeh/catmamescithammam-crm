@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="header bg-primary pb-6">
<div class="container-fluid">
    <div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0 item-text font-weight-600">Arayüz </h6>
        </div>
    </div>
    <div class="row">
        @can('show reservation')

            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-dashboard-card">Rezervasyonlar</h5>
                                <hr>
                                <a href="{{ route('reservation.index', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span class="h2 mb-0 count-card">{{ $reservationCount }}</span>
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                    <i class="fa fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('show contactform')
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-dashboard-card">Rezervasyon Formları</h5>
                            <hr>
                            <a href="{{ route('bookingform.index', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                <span class="h2 mb-0 count-card">{{ $bookingFormCount }}</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fa fa-wpforms"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-dashboard-card">İletişim Formları</h5>
                            <hr>
                            <a href="{{ route('contactform.index', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                <span class="h2 mb-0 count-card">{{ $contactFormCount }}</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fa fa-wpforms"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0" style="padding: 0; padding-top: 10px">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Otel Komisyon Özetleri</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <canvas id="hotel-chart" width="800" height="450"></canvas>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0" style="padding: 0; padding-top: 10px">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Terapist Özetleri</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <canvas id="therapist-chart-all" width="800" height="450"></canvas>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0" style="padding: 0; padding-top: 10px">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Hizmet Özetleri</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <canvas id="services-chart-all" width="800" height="450"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
    <script>
        // Source Report
        // var sourceLabels = @json($sourceLabels);
        // var sourceData = @json($sourceData);
        // var sourceColors = @json($sourceColors);
        // var SourceChart = new Chart(document.getElementById("source-chart-all"), {
        //     type: 'bar',
        //     data: {
        //         labels: sourceLabels,
        //         datasets: [{
        //             label: 'Rezervasyon Kaynak Özetleri',
        //             data: sourceData,
        //             backgroundColor: sourceColors,
        //             borderColor: 'rgba(255, 99, 132, 1)',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero: true
        //                 }
        //             }]
        //         }
        //     }
        // });
        // Therapist  Report
        // var therapistLabels = @json($therapistLabels);
        // var therapistData = @json($therapistData);
        // var therapistColors = @json($therapistColors);
        // var therapistChart = new Chart(document.getElementById("therapist-chart-all"), {
        //     type: 'bar',
        //     data: {
        //         labels: therapistLabels,
        //         datasets: [{
        //             label: 'Terapist Özetleri',
        //             data: therapistData,
        //             backgroundColor: therapistColors,
        //             borderColor: 'rgba(255, 99, 132, 1)',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero: true
        //                 }
        //             }]
        //         }
        //     }
        // });
        // Services  Report
        var serviceLabels = @json($serviceLabels);
        var serviceData = @json($serviceData);
        var serviceColors = @json($serviceColors);
        var serviceChart = new Chart(document.getElementById("services-chart-all"), {
            type: 'bar',
            data: {
                labels: serviceLabels,
                datasets: [{
                    label: 'Hizmet Özetleri',
                    data: serviceData,
                    backgroundColor: serviceColors,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        // Get hotel commission data from Laravel view
            var hotelComissionLabels = @json($hotelComissionLabels);
            var hotelComissionData   = @json($hotelComissionData);
            var hotelComissionColors = @json($hotelComissionColors);
        // Create hotel commission chart
            var hotelComissionChart = new Chart(document.getElementById("hotel-chart"), {
                type: 'bar',
                data: {
                    labels: hotelComissionLabels,
                    datasets: [{
                        label: 'Otel Komisyon Raporu',
                        data: hotelComissionData,
                        backgroundColor: hotelComissionColors,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
    </script>
@endsection
