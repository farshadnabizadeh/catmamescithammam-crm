@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <div class="card p-5 mt-3">
                <div class="card-title">
                    <h2>Reservations Lists</h2>
                    <button data-toggle="modal" data-target="#reservationModal" class="btn btn-success float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Reservation</button>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Reservation Time</th>
                                <th scope="col">Total Customer</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Service Currency</th>
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
                            <td>{{ $reservation->arrival_date }}</td>
                            <td>{{ $reservation->arrival_time }}</td>
                            <td>{{ $reservation->total_customer }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="arrivalDate">Reservation Date</label>
                                <input type="text" class="form-control datepicker" id="arrivalDate" name="arrivalDate" placeholder="Enter Reservation Date" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="arrivalTime">Reservation Time</label>
                                <input type="text" class="form-control" id="arrivalTime" name="arrivalTime" placeholder="Enter Reservation Time" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="totalCustomer">Total Customer</label>
                                <input type="number" class="form-control" id="totalCustomer" name="totalCustomer" placeholder="Enter Total Customer" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceId">Service</label>
                                <select id="serviceId" name="serviceId" class="form-control" required>
                                    <option></option>
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCurrency">Service Currency</label>
                                <select id="serviceCurrency" name="serviceCurrency" class="form-control">
                                    <option></option>
                                    <option value="EUR">EURO</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="TL">TL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCost">Service Cost</label>
                                <input type="number" class="form-control" id="serviceCost" name="serviceCost" placeholder="Enter Service Cost">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceComission">Service Comission</label>
                                <input type="number" class="form-control" id="serviceComission" name="serviceComission" placeholder="Enter Service Comission">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="therapistId">Therapist</label>
                                <select id="therapistId" name="therapistId" onchange="getServiceDetail(this)" class="form-control">
                                    <option></option>
                                    @foreach ($therapists as $therapist)
                                    <option value="{{ $therapist->id }}">{{ $therapist->therapist_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#add-customer-modal" class="btn btn-outline-primary mb-3" title="Add Customer To This Reservation">Add Customer</button>
                    <button type="submit" class="btn btn-success float-right" id="reservationSave">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
                <table class="table table-bordered" id="customerTableReservation">
                    <tr>
                        <th>Customer Name</th>
                        <th></th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }} {{ $customer->customer_surname }}</option>
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