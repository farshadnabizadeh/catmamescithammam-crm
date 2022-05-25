@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>{{ $tableTitle }}</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create treatmentplan')
                            <a href="{{ url('/definitions/treatmentplans/create') }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Request</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">ID</th>
                                <th scope="col">Rezervasyon Tarihi</th>
                                <th scope="col">Rezervasyon Saati</th>
                                <th scope="col">Müşteri Adı</th>
                                <th scope="col">Total Customer</th>
                                <th scope="col">Ödeme Türü</th>
                                <th scope="col">Hizmet Adı</th>
                                <th scope="col">Hizmet Bedeli</th>
                                <th scope="col">Terapist</th>
                            </tr>
                        </thead>
                        @foreach ($listAllByDates as $listAllByDate)
                            <tr>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ url('/operation/cancel/'.$listAllByDate->tId) }}" class="btn btn-danger edit-btn" onclick="return confirm('Are you sure?');"><i class="fa fa-ban"></i> İptal Et</a></li>
                                            <li><a href="{{ url('/operationbydate/edit/'.$listAllByDate->tId) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Güncelle</a></li>
                                            <li><a href="{{ url('/definitions/treatmentplans/download/'.$listAllByDate->tId) }}" class="btn btn-success edit-btn"><i class="fa fa-download"></i> İndir</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ date('ymd', strtotime($listAllByDate->date)) }}{{ $listAllByDate->customer_id }}{{ $listAllByDate->id }}</td>
                                <td>{{ $listAllByDate->reservation_date }}</td>
                                <td>{{ $listAllByDate->reservation_time }}</td>
                                <td><a href="{{ url('/definitions/customers/edit/'.$listAllByDate->customer_id) }}">{{ $listAllByDate->Cname }}</a></td>
                                <td>{{ $listAllByDate->total_customer }}</td>
                                <td>{{ $listAllByDate->payment_type_name }}</td>
                                <td>{{ $listAllByDate->service_name }}</td>
                                <td>{{ $listAllByDate->service_cost }} {{ $listAllByDate->service_currency }}</td>
                                <td>{{ $listAllByDate->therapist_name }}</td>
                            </tr>
                        @endforeach
                    </table>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection