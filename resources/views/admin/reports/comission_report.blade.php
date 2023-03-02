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
                    <h3>{{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }} tarihleri arasındaki Komisyon Raporu</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Otel Komisyon Raporu</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="hotel-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Rehber Komisyon Raporu</h3></h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="guide-chart"></canvas>
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
    // Get hotel commission data from Laravel view
    var hotelComissionLabels = @json($hotelComissionLabels);
    var hotelComissionData = @json($hotelComissionData);
    var hotelComissionColors = @json($hotelComissionColors);

    // Get guide commission data from Laravel view
    var guideComissionLabels = @json($guideComissionLabels);
    var guideComissionData = @json($guideComissionData);
    var guideComissionColors = @json($guideComissionColors);

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

    // Create guide commission chart
    var guideComissionChart = new Chart(document.getElementById("guide-chart"), {
        type: 'bar',
        data: {
            labels: guideComissionLabels,
            datasets: [{
                label: 'Rehber Komisyon Raporu',
                data: guideComissionData,
                backgroundColor: guideComissionColors,
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
</script>
@endsection
