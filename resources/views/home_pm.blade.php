@extends('layouts.app')

@section('content')
    @include('layouts.navbar')

    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0" style="padding: 0; padding-top: 10px">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">Rezervasyon Kaynak Özetleri</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 0">
                                <canvas id="source-chart" width="800" height="450"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0" style="padding: 0; padding-top: 10px">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">Ciro Özetleri</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 0">
                                <canvas id="payment-type-chart-3"  width="800" height="450"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @section('footer')
        <script>

            // Ciro Report
            var all_paymentLabels = @json($all_paymentLabels);
            var all_paymentData = @json($all_paymentData);
            var all_paymentColors = @json($all_paymentColors);
            var hotelComissionChart = new Chart(document.getElementById("payment-type-chart-3"), {
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
