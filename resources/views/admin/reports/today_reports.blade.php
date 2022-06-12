@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-md-4">
            <a href="{{ url('/definitions/reports?set=total') }}">
                <div class="info-box mt-3">
                    <span class="info-box-icon bg-primary"><i class="fa fa-calendar"></span>
                    <div class="info-box-content"><span class="info-box-text">Toplam</span></div>
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
                <div class="info-box bg-danger">
                    <span class="info-box-icon bg-primary"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-white">Bugün</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Toplam</h2>
                    {{ $today }}
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
