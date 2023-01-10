@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Arayüz</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kullanıcılar</li>   
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Kullanıcılar</h2>
                        </div>
                        <div class="col-lg-6">
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Kullanıcı</button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">İşlem</th>
                            <th scope="col">Rolü</th>
                            <th scope="col">Kullanıcı Adı</th>
                            <th scope="col">Email Adresi</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Güncelle</a></li>
                                    <li><a href="{{ route('user.destroy', ['id' => $user->id]) }}" onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>@foreach($user->roles as $key => $value){{ $value->name.' '}}@endforeach</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @endforeach
               </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yeni Kullanıcı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Kullanıcı Adı</label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="Kullanıcı Adı" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userEmail">Email Adresi</label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Email Adresi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userPassword">Şifresi</label>
                                <input type="text" class="form-control" id="userPassword" name="userPassword" placeholder="Şifresi" required>
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
