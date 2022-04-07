@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Customers Lists</h2>
                        </div>
                        <div class="col-lg-6">
                            <button data-toggle="modal" data-target="#customerModal" class="btn btn-success float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Customer</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Surname</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Customer Country</th>
                                <th scope="col">Customer Email</th>
                                <th scope="col">Customer Source</th>
                            </tr>
                        </thead>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/definitions/customers/edit/'.$customer->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        <li><a href="{{ url('/definitions/customers/destroy/'.$customer->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_surname }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                            <td>{{ $customer->customer_country }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td style="background-color: {{ $customer->sob->source_color }}; color: #fff">{{ $customer->sob->source_name }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/definitions/customers/store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerName">Customer Name</label>
                                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Enter Customer Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerSurname">Customer Surname</label>
                                <input type="text" class="form-control" id="customerSurname" name="customerSurname" placeholder="Enter Customer Surname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone_get">Customer Phone</label>
                                <input type="text" class="form-control" id="phone_get" name="customerPhone" placeholder="Enter Customer Phone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerCountry">Customer Country</label>
                                <input type="text" class="form-control" id="country_get" name="customerCountry" placeholder="Enter Customer Country" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerEmail">Customer Email</label>
                                <input type="email" class="form-control" id="customerEmail" name="customerEmail" placeholder="Enter Customer Email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerSobId">Source Of Booking</label>
                                <select id="customerSobId" name="customerSobId" class="form-control" required>
                                    <option></option>
                                    @foreach ($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->source_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right" id="saveCustomerBtn">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
