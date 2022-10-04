@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Arayüz</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rezervasyon Kaynakları</li>
                </ol>
            </nav>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Rezervasyon Kaynakları</h2>
                        </div>
                        <div class="col-lg-6">
                            @can('create sources')
                            <button data-toggle="modal" data-target="#sourceModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Rezervasyon Kaynağı Ekle</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">İşlem</th>
                                <th scope="col">Kaynak Adı</th>
                                <th scope="col">Kaynak Rengi</th>
                            </tr>
                        </thead>
                        @foreach ($sources as $source)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        @can('edit sources')
                                        <li><a href="{{ route('source.edit', ['id' => $source->id]) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Güncelle</a></li>
                                        @endcan
                                        @can('delete sources')
                                        <li><a href="{{ route('source.destroy', ['id' => $source->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $source->name }}</td>
                            <td style="background-color: {{ $source->color }}"></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sourceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yeni Rezervasyon Kaynağı Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('source.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Kaynak Adı</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Kaynak Adı" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="color">Kaynak Rengi</label>
                                <input type="text" class="form-control" id="colorpicker" value='#276cb8' name="color" placeholder="Kaynak Rengi">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

@endsection
