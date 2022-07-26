@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Durumu Güncelle</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $form_status->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/formstatuses/update/'.$form_status->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="statusName">Durum Adı</label>
                                <input type="text" class="form-control" id="statusName" name="statusName" placeholder="Durum Adı" value="{{ $form_status->status_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="statusColor">Durum Rengi</label>
                                <input type="text" class="form-control" id="colorpicker" name="statusColor" placeholder="Durum Rengi" value="{{ $form_status->status_color }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
