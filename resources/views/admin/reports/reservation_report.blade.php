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
                                <div class="col-lg-4">
                                    <label for="startDate">Başlangıç Tarihi</label>
                                    <input type="text" class="form-control datepicker" id="startDate" name="startDate"
                                        placeholder="Başlangıç Tarihi" value="{{ $start }}" autocomplete="off"
                                        required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="endDate">Bitiş Tarihi</label>
                                    <input type="text" class="form-control datepicker" id="endDate" name="endDate"
                                        placeholder="Bitiş Tarihi" autocomplete="off" value="{{ $end }}" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="selectedSource">Kaynaklar</label>
                                    <select name="selectedSource[]" id="selectedSource" multiple>
                                        <option value=""></option>
                                        @foreach ($sourcesSelect as $source)
                                            @if (in_array($source->id, $selectedSources))
                                                <option value="{{$source->id}}" selected>{{$source->name}}</option>
                                            @else
                                                <option value="{{$source->id}}">{{$source->name}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12">
                                    <button class="btn btn-success mt-3 float-right" type="submit"><i
                                            class="fa fa-check"></i> Raporu Al</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-3 pl-3">
            <div class="d-flex">
                <button class="btn btn-primary" onclick="scrollToCiro()">Ciro Raporu</button>
                <button class="btn btn-primary" onclick="scrollToTherapist()">Terapist Raporu</button>
                <button class="btn btn-primary" onclick="scrollToService()">Hizmet Raporu</button>
                <button class="btn btn-primary" onclick="scrollToReservation()">Rezervasyon Kaynak Raporu</button>
                <button class="btn btn-primary" onclick="scrollToHotelComission()">Otel Komisyon</button>
                <button class="btn btn-primary" onclick="scrollToGuideComission()">Rehber Komisyon</button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }} tarihleri
                            arasındaki Rezervasyon Raporu</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card p-3 report-card">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h3>Tarihe Göre Rezervasyon Adetleri</h3>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-success float-right download-report-btn mt-1" onclick="tableDataExcel()"><i class="fa fa-download"></i> İndir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>TOPLAM Rezervasyon: <b class="ml-3">{{ $reservationByDateCount }}</b></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>TOPLAM Kişi: <b class="ml-3">{{ $paxByDateCount }}</b></p>
                                        </div>
                                    </div>
                                    <hr class="pb-3">
                                    <div class="col-lg-12">
                                        <table id="tableData" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Tarih</th>
                                                    <th>Toplam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sourcesAllByDate as $source)
                                                    <tr>
                                                        <td>{{ date('d-m-Y', strtotime($source->reservation_date)) }}</td>
                                                        <td>{{ $source->sourceCount }} Reservation / {{ $source->paxCount }} Pax
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Tarihe Göre Rezervasyon Kaynağı</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="source-date-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card p-3 report-card" id="reservation">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h3>Rezervasyon Kaynak Özetleri</h3>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-success float-right download-report-btn mt-1" onclick="tableSourceExcel()"><i class="fa fa-download"></i> İndir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>TOPLAM Rezervasyon: <b class="ml-3">{{ $reservationByDateCount }}</b></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>TOPLAM Kişi: <b class="ml-3">{{ $paxByDateCount }}</b></p>
                                        </div>
                                    </div>
                                    <hr class="pb-3">
                                    <div class="col-lg-12">
                                        <table id="tableSource" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Kaynak Adı</th>
                                                    <th>Toplam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sourcesAll as $source)
                                                    <tr>
                                                        <td>{{ $source->source->name }}</td>
                                                        <td>{{ $source->sourceCount }} Reservation / {{ $source->paxCount }}
                                                            Pax</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Rezervasyon Kaynak Özetleri</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="source-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-lg-12">
                                    <div id="root">
                                        <div class="card" id="ciro">
                                            <div class="card-header">
                                                <h3>{{ date('d-m-Y', strtotime($start)) }} &
                                                    {{ date('d-m-Y', strtotime($end)) }} tarihleri arasındaki Ciro Raporu
                                                </h3>
                                            </div>
                                            <div class="card-body" style="padding: 0; padding-top: 10px">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>CASH TL:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>₺ {{ number_format($cashTl, 2) }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>CASH DOLAR:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>$ {{ number_format($cashUsd, 2) }}</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>CASH EURO:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>€ {{ number_format($cashEur, 2) }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>CASH POUND:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>£ {{ number_format($cashPound, 2) }}</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>ZİRAAT KK TL:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>₺ {{ number_format($ziraatTl, 2) }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>ZİRAAT KK DOLAR:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>$ {{ number_format($ziraatDolar, 2) }}</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>ZİRAAT KK EURO:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>€ {{ number_format($ziraatEuro, 2) }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>VIATOR EURO:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>€ {{ number_format($viatorEuro, 2) }}</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>YKB KK TL:</p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <b>€ {{ number_format($ykbTl, 2) }}</b>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p>TOPLAM EURO: <b class="ml-3">€
                                                                {{ number_format($totalEuro, 2) }}</b></p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <p>TOPLAM TL: <b class="ml-3">₺
                                                                {{ number_format($totalTl, 2) }}</b></p>
                                                    </div>

                                                        <div class="col-lg-6">
                                                            <p>Ortalama Kisi Bası Euro:
                                                                <b class="ml-3">
                                                                    € @if ($totalEuro > 0)
                                                                        {{number_format(($totalEuro/$paxByDateCount),2) }}
                                                                    @else
                                                                        {{number_format(0,2)}}
                                                                    @endif
                                                                </b>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p>Ortalama Kisi Bası TL:
                                                                <b class="ml-3">
                                                                    @if ($totalTl > 0)
                                                                        ₺ {{number_format(($totalTl/$paxByDateCount),2) }}
                                                                    @else
                                                                        ₺ {{number_format(0,2)}}
                                                                    @endif
                                                                </b>
                                                            </p>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Ciro Raporu</h3>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="payment-type-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="root">
                                    <div class="card p-3 report-card">
                                        <div class="card-title">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h3>Otel Komisyon Raporu</h3>
                                                </div>
                                                <div class="col-lg-4">
                                                    <button class="btn btn-success float-right download-report-btn mt-1" onclick="tableHotelsExcel()"><i class="fa fa-download"></i> İndir</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>TOPLAM Otel Komisyonu: <b class="ml-3">₺ {{ number_format($hotelComissionsCount, 2) }}</b></p>
                                            </div>
                                        </div>
                                        <hr class="pb-3">
                                        <div class="card-body" style="padding: 0; padding-top: 10px">
                                            <div class="col-lg-12">
                                                <table id="tableHotels" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Otel Adı</th>
                                                            <th>Alınan Komisyon Sayısı</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($hotelComissions as $hotelComission)
                                                            <tr>
                                                                <td>{{ $hotelComission->name }}</td>
                                                                <td>{{ number_format($hotelComission->totalPrice, 2) . ' TL' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Otel Komisyon Raporu</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="hotel-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card p-3">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h3>Rehber Komisyon Raporu</h3>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-success float-right download-report-btn mt-1" onclick="tableGuidesExcel()"><i class="fa fa-download"></i> İndir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>TOPLAM Rehber Komisyonu: <b class="ml-3">₺ {{ number_format($guideComissionsCount, 2) }}</b></p>
                                        </div>
                                    </div>
                                    <hr class="pb-3">
                                    <div class="card-body" style="padding: 0; padding-top: 10px">
                                        <div class="col-lg-12">
                                            <table id="tableGuides" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Rehber Adı</th>
                                                        <th>Alınan Komisyon Sayısı</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($guideComissions as $guideComission)
                                                        <tr>
                                                            <td>{{ $guideComission->name }}</td>
                                                            <td>{{ number_format($guideComission->totalPrice, 2) . ' TL' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Rehber Komisyon Raporu</h3>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="guide-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card p-3 report-card" id="service">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h3>Hizmet Raporu</h3>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-success float-right download-report-btn mt-1" onclick="tableServiceExcel()"><i class="fa fa-download"></i> İndir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <table id="tableService" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Bakım</th>
                                                    <th>Yaptığı Bakım</th>
                                                    <th>Toplam Fiyat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($serviceAll as $service)
                                                    <tr>
                                                        <td>{{ $service->name }}</td>
                                                        <td>{{ $service->serviceCount }}</td>
                                                        <td>{{ $service->cost * $service->serviceCount . ' EURO' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Hizmet Raporu</h3>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="service-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card p-3 report-card" id="therapist">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h3>Terapist  Raporu</h3>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-success float-right download-report-btn mt-1" onclick="therapistExcel()"><i class="fa fa-download"></i> İndir</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Terapist Adı</th>
                                                    <th>Yaptığı Bakım</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($therapistAll as $therapist)
                                                    <tr>
                                                        <td>{{ $therapist->name }}</td>
                                                        <td>{{ $therapist->therapistCount }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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

        // Source Report
        var sourceLabels = @json($sourceLabels);
        var sourceData = @json($sourceData);
        var sourceColors = @json($sourceColors);
        var hotelComissionChart = new Chart(document.getElementById("source-chart"), {
            type: 'bar',
            data: {
                labels: sourceLabels,
                datasets: [{
                    label: 'Rezervasyon Kaynak Özetleri',
                    data: sourceData,
                    backgroundColor: sourceColors,
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

        // Source By Date Report
        var sourcesByDateLabels = @json($sourcesByDateLabels);
        var sourcesByDateData = @json($sourcesByDateData);
        var sourcesByDateColors = @json($sourcesByDateColors);
        var hotelComissionChart = new Chart(document.getElementById("source-date-chart"), {
            type: 'bar',
            data: {
                labels: sourcesByDateLabels,
                datasets: [{
                    label: 'Tarihe Göre Rezervasyon Kaynağı',
                    data: sourcesByDateData,
                    backgroundColor: sourcesByDateColors,
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
