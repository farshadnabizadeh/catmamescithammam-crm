@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Arayüz</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Roller</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Roller</h2>
                        </div>
                        <div class="col-md-6">
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Rol Ekle</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">İşlemler</th>
                                <th scope="col">Rol Adı</th>
                            </tr>
                        </thead>
                        @foreach ($roles as $role)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/roles/edit/'.$role->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Güncelle</a></li>
                                        <li><a href="{{ url('/roles/clone/'.$role->id) }}" class="btn btn-warning edit-btn"><i class="fa fa-clone"></i> Clone Role</a></li>
                                        <li><a href="{{ url('/roles/delete/'.$role->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $role->name }}</td>
                        </tr>
                        @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
