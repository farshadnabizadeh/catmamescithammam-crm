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
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Reservations Lists</h2>
                        </div>
                        <div class="col-lg-6">
                            <button data-toggle="modal" data-target="#reservationModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Reservation</button>
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
                                <input type="text" class="form-control" id="arrivalTime" name="arrivalTime" placeholder="Enter Reservation Time" maxlength="5" onkeypress="timeFormat(this)" autocomplete="off" required>
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
                                <label for="discountId">Discount</label>
                                <select id="discountId" name="discountId" onchange="getDiscountDetail(this)" class="form-control">
                                    <option></option>
                                    @foreach ($discounts as $discount)
                                    <option value="{{ $discount->id }}">{{ $discount->discount_name }} | %{{ $discount->discount_percentage }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceComission">Service Comission</label>
                                <input type="number" class="form-control" id="serviceComission" name="serviceComission" placeholder="Enter Service Comission">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="therapistId">Therapist</label>
                                <select id="therapistId" name="therapistId" class="form-control">
                                    <option></option>
                                    @foreach ($therapists as $therapist)
                                    <option value="{{ $therapist->id }}">{{ $therapist->therapist_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                    </div>
                    <button type="button" data-toggle="modal" data-target="#add-customer-modal" class="btn btn-outline-primary mb-3" title="Add Customer To This Reservation">Add Customer</button>
                    <button type="button" class="btn btn-success float-right" id="reservationSave">Save <i class="fa fa-check" aria-hidden="true"></i></button>
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