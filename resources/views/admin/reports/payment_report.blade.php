@extends('layouts.app')

@section('content')
    @include('layouts.navbar')

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <button class="btn btn-danger" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki
                    Sayfa</button>
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row pb-3">
                                <div class="col-lg-6">
                                    <label for="startDate">Başlangıç Tarihi</label>
                                    <input type="text" class="form-control datepicker" id="startDate" name="startDate"
                                        placeholder="Başlangıç Tarihi" value="{{ $start }}" autocomplete="off"
                                        required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="endDate">Bitiş Tarihi</label>
                                    <input type="text" class="form-control datepicker" id="endDate" name="endDate"
                                        placeholder="Bitiş Tarihi" autocomplete="off" value="{{ $end }}" required>
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
                <button class="btn btn-primary float-right download-report-btn" onclick="paymentReportPdf();"><i
                        class="fa fa-download"></i> İndir</button>
            </div>
            <div class="col-lg-12">
                <div id="root">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }} tarihleri
                                arasındaki Ciro Raporu</h3>
                        </div>
                        <div class="card-body" style="padding: 0; padding-top: 10px">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>CASH TL:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>₺ {{ number_format($cashTl, 2) }}</b>
                                </div>
                                <div class="col-lg-4">
                                    <p>YKB KK TL:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>₺ {{ number_format($ykbTl, 2) }}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>CASH EURO:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>€ {{ number_format($cashEur, 2) }}</b>
                                </div>
                                <div class="col-lg-4">
                                    <p>ZİRAAT KK TL:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>₺ {{ number_format($ziraatTl, 2) }}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>CASH DOLAR:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>$ {{ number_format($cashUsd, 2) }}</b>
                                </div>
                                <div class="col-lg-4">
                                    <p>ZİRAAT KK EURO:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>€ {{ number_format($ziraatEuro, 2) }}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>CASH POUND:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>£ {{ number_format($cashPound, 2) }}</b>
                                </div>
                                <div class="col-lg-4">
                                    <p>ZİRAAT KK DOLAR:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>$ {{ number_format($ziraatDolar, 2) }}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>VIATOR EURO:</p>
                                </div>
                                <div class="col-lg-2">
                                    <b>€ {{ number_format($viatorEuro, 2) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Ciro Raporu</h3>
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
        // Get hotel commission data from Laravel view
        var all_paymentLabels = @json($all_paymentLabels);
        var all_paymentData = @json($all_paymentData);
        var all_paymentColors = @json($all_paymentColors);

        // Create hotel commission chart
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
