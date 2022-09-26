@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Arayüz</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Otel Listesi</li>
                </ol>
            </nav>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Otel Listesi</h2>
                        </div>
                        <div class="col-lg-6">
                            @can('create hotel')
                            <button data-toggle="modal" data-target="#hotelModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Otel Ekle</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">İşlem</th>
                                <th scope="col">Adı</th>
                                <th scope="col">Numarası</th>
                                <th scope="col">Görevli Adı</th>
                                <th scope="col">Banka Iban Numarası</th>
                            </tr>
                        </thead>
                        @foreach ($hotels as $hotel)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        @can('edit hotel')
                                            <li><a href="{{ route('hotel.edit', ['id' => $hotel->id]) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Güncelle</a></li>
                                        @endcan
                                        @can('delete hotel')
                                            <li><a href="{{ route('hotel.destroy', ['id' => $hotel->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $hotel->name }}</td>
                            <td>{{ $hotel->phone }}</td>
                            <td>{{ $hotel->person }}</td>
                            <td>{{ $hotel->person_account_number }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hotelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yeni Otel Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hotel.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Otel Adı</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Otel Adı" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Otel Telefon Numarası</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Otel Telefon Numarası">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="person">Hotel Person</label>
                                <input type="text" class="form-control" id="person" name="person" placeholder="Enter Hotel Person">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="personAccountNumber">Hotel Person Account Number</label>
                                <input type="text" class="form-control" id="personAccountNumber" name="personAccountNumber" placeholder="Enter Hotel Person Account Number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="personSendAmount">Hotel Person Send Amount</label>
                                <input type="number" class="form-control" id="personSendAmount" name="personSendAmount" placeholder="Enter Hotel Person Send Amount">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

@endsection
