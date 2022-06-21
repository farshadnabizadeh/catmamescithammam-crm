@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-md-4">
            <a href="{{ url('/definitions/reports?set=total') }}">
                <div class="info-box bg-danger mt-3">
                    <span class="info-box-icon bg-primary"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content"><span class="info-box-text text-white">Toplam</span></div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4">
            <a href="{{ url('/definitions/reports?set=month') }}">
                <div class="info-box mt-3">
                    <span class="info-box-icon bg-primary"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bu Ay</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4">
            <a href="{{ url('/definitions/reports?set=week') }}">
                <div class="info-box mt-3">
                    <span class="info-box-icon bg-primary"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bu Hafta</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-4">
            <a href="{{ url('/definitions/reports?set=today') }}">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bugün</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card p-3">
                <div class="card-title">
                    <h2>Terapist Raporu</h2>
                </div>
                <table id="basic-btn" class="table table-striped table-bordered nowrap">
                    <thead>
                    <tr>
                        <th>Terapist Adı</th>
                        <th>Yaptığı Bakım</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($therapistAll as $therapist)
                        <tr>
                            <td>{{$therapist->therapist_name}}</td>
                            <td>{{$therapist->aCount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <div class="card-title">
                    <h2>Hizmet Raporu</h2>
                </div>
                <table id="tableData" class="table table-striped table-bordered nowrap">
                    <thead>
                    <tr>
                        <th>Terapist Adı</th>
                        <th>Yaptığı Bakım</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($serviceAll as $service)
                        <tr>
                            <td>{{$service->service_name}}</td>
                            <td>{{$service->aCount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




@endsection
