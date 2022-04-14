@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Services Lists</h2>
                        </div>
                        <div class="col-lg-6">
                            <button data-toggle="modal" data-target="#serviceModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Service</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Service Currency</th>
                                <th scope="col">Service Cost</th>
                            </tr>
                        </thead>
                        @foreach ($services as $service)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/definitions/services/edit/'.$service->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        <li><a href="{{ url('/definitions/services/destroy/'.$service->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $service->service_name }}</td>
                            <td>{{ $service->service_currency }}</td>
                            <td>{{ $service->service_cost }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/definitions/services/store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceName">Service Name</label>
                                <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="Enter Service Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCurrency">Service Currency</label>
                                <select id="serviceCurrency" name="serviceCurrency" class="form-control" required>
                                    <option></option>
                                    <option value="EUR">EURO</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="TL">TL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="serviceCost">Service Cost</label>
                                <input type="number" class="form-control" id="serviceCost" name="serviceCost" placeholder="Enter Service Cost" required>
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
