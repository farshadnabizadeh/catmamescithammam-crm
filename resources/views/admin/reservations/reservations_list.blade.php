@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Arayüz</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rezervasyonlar</li>
                </ol>
            </nav>
            <div class="card">
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
                            <button class="btn btn-success mt-3 float-right" type="submit">Rezervasyonları Listele <i class="fa fa-check"></i></button>
                         </div>
                      </div>
                   </form>
                </div>
            </div>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Rezervasyonlar</h2>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('reservation.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Rezervasyon</a>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    {!! $html->table() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
{!! $html->scripts() !!}

@endsection