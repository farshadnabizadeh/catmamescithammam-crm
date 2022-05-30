@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Arayüz</a></li>
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
                                <th scope="col">Operation</th>
                                <th scope="col">Otel Adı</th>
                                <th scope="col">Otel Numarası</th>
                                <th scope="col">Otel Görevlisi</th>
                                <th scope="col">Hotel Person Account Number</th>
                                <th scope="col">Amount Shipped</th>
                            </tr>
                        </thead>
                        @foreach ($hotels as $hotel)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        @can('edit hotel')
                                        <li><a href="{{ url('/definitions/hotels/edit/'.$hotel->id) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Güncelle</a></li>
                                        @endcan
                                        @can('delete hotel')
                                        <li><a href="{{ url('/definitions/hotels/destroy/'.$hotel->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $hotel->hotel_name }}</td>
                            <td>{{ $hotel->hotel_phone }}</td>
                            <td>{{ $hotel->hotel_person }}</td>
                            <td>{{ $hotel->hotel_person_account_number }}</td>
                            <td>{{ $hotel->hotel_person_send_amount }}</td>
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
                <form action="{{ url('/definitions/hotels/store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hotelName">Otel Adı</label>
                                <input type="text" class="form-control" id="hotelName" name="hotelName" placeholder="Otel Adı" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hotelPhone">Otel Telefon Numarası</label>
                                <input type="text" class="form-control" id="hotelPhone" name="hotelPhone" placeholder="Otel Telefon Numarası">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hotelPerson">Hotel Person</label>
                                <input type="text" class="form-control" id="hotelPerson" name="hotelPerson" placeholder="Enter Hotel Person">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hotelPersonAccountNumber">Hotel Person Account Number</label>
                                <input type="text" class="form-control" id="hotelPersonAccountNumber" name="hotelPersonAccountNumber" placeholder="Enter Hotel Person Account Number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hotelPersonSendAmount">Hotel Person Send Amount</label>
                                <input type="number" class="form-control" id="hotelPersonSendAmount" name="hotelPersonSendAmount" placeholder="Enter Hotel Person Send Amount">
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
