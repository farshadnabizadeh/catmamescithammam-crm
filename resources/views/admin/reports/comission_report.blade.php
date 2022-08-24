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
            <button class="btn btn-primary float-right download-report-btn" onclick="paymentReportPdf();"><i class="fa fa-download"></i> İndir</button>
        </div>
        <div class="col-lg-12">
            <div id="root">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card p-3">
                            <div class="card-title">
                                <h2>Otel Komisyon Raporu</h2>
                            </div>
                            <div class="card-body" style="padding: 0; padding-top: 10px">
                                <div class="col-lg-12">
                                    <table id="tableGuides" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Otel Adı</th>
                                                <th>Alınan Komisyon Sayısı</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($hotelComissions as $hotelComission)
                                            <tr>
                                                <td>{{ $hotelComission->name }}</td>
                                                <td>{{ $hotelComission->aCount . ' TL' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-3">
                            <div class="card-title">
                                <h2>Rehber Komisyon Raporu</h2>
                            </div>
                            <div class="card-body" style="padding: 0; padding-top: 10px">
                                <div class="col-lg-12">
                                    <table id="tableData" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Otel Adı</th>
                                                <th>Alınan Komisyon Sayısı</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($guideComissions as $guideComission)
                                            <tr>
                                                <td>{{ $guideComission->name }}</td>
                                                <td>{{ $guideComission->aCount . ' TL' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
