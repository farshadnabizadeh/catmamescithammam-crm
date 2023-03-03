@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <button class="btn btn-danger" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
            <div class="card mt-3">
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row pb-3">
                            <div class="col-lg-6">
                                <label for="startDate">Başlangıç Tarihi</label>
                                <input type="text" class="form-control datepicker" id="startDate" name="startDate" placeholder="Başlangıç Tarihi" value="{{ $start }}" autocomplete="off" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="endDate">Bitiş Tarihi</label>
                                <input type="text" class="form-control datepicker" id="endDate" name="endDate" placeholder="Bitiş Tarihi" autocomplete="off" value="{{ $end }}" required>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-success mt-3 float-right" type="submit">Raporu Al</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }} tarihleri arasındaki Rezervasyon Raporu</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Terapist Raporu</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="therapist-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Hizmet Raporu</h3></h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="service-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ciro Raporu</h3></h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="payment-type-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer')
<script>
    var therapistLabels = @json($therapistLabels);
    var therapistData = @json($therapistData);
    var therapistColors = @json($therapistColors);

    var serviceLabels = @json($serviceLabels);
    var serviceData = @json($serviceData);
    var serviceColors = @json($serviceColors);

    var therapistChart = new Chart(document.getElementById("therapist-chart"), {
        type: 'bar',
        data: {
            labels: therapistLabels,
            datasets: [{
                label: 'Terapist Raporu',
                data: therapistData,
                backgroundColor: therapistColors,
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

    var serviceChart = new Chart(document.getElementById("service-chart"), {
        type: 'bar',
        data: {
            labels: serviceLabels,
            datasets: [{
                label: 'Hizmet Raporu',
                data: serviceData,
                backgroundColor: serviceColors,
                borderColor: 'rgba(54, 162, 235, 1)',
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
// Ciro Report
    var all_paymentLabels = @json($all_paymentLabels);
        var all_paymentData = @json($all_paymentData);
        var all_paymentColors = @json($all_paymentColors);
        var hotelComissionChart = new Chart(document.getElementById("payment-type-chart"), {
            type: 'bar',
            data: {
                labels: all_paymentLabels,
                datasets: [{
                    label: 'Ciro Raporu',
                    data: all_paymentData,
                    backgroundColor: all_paymentColors,
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
