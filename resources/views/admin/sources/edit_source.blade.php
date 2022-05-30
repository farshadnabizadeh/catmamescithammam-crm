@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Rezervasyon Kaynağını Güncelle</h2>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $source->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/sources/update/'.$source->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sourceName">Kaynak Adı</label>
                                <input type="text" class="form-control" id="sourceName" name="sourceName" placeholder="Kaynak Adı" value="{{ $source->source_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sourceColor">Kaynak Rengi</label>
                                <input type="text" class="form-control" id="colorpicker" name="sourceColor" placeholder="Kaynak Rengi" value="{{ $source->source_color }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
