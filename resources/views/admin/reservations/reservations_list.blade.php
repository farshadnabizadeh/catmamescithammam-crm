@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reservations</li>
                </ol>
            </nav>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Reservations</h2>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ url('/definitions/reservations/create') }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Reservation</a>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Reservation Time</th>
                                <th scope="col">Total Customer</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Service Cost</th>
                                <th scope="col">Commission</th>
                                <th scope="col">Therapist</th>
                            </tr>
                        </thead>
                        @foreach ($reservations as $reservation)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/definitions/reservations/edit/'.$reservation->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        <li><a href="{{ url('/definitions/reservations/destroy/'.$reservation->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ date('d/m/Y', strtotime($reservation->reservation_date)) }}</td>
                            <td>{{ $reservation->reservation_time }}</td>
                            <td>{{ $reservation->total_customer }}</td>
                            <td>{{ $reservation->service->service_name }}</td>
                            <td>{{ $reservation->service_cost }} {{ $reservation->service_currency }}</td>
                            <td>{{ $reservation->service_commission }}</td>
                            <td>{{ $reservation->therapist->therapist_name }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-customer-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Customer</h4>
                <button type="button" class="close add-reservation-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="customerId">Customer</label>
                                    <select id="customerId" class="form-control" name="customerId">
                                        <option></option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }} {{ $customer->customer_surname }} / {{ $customer->customer_country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12">
                    <button type="button" class="btn btn-success float-right" id="addCustomertoReservationSave">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection