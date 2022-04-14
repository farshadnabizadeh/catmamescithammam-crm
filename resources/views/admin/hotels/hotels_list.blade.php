@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hotels</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Hotels Lists</h2>
                        </div>
                        <div class="col-lg-6">
                            <button data-toggle="modal" data-target="#hotelModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Hotel</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Hotel Name</th>
                                <th scope="col">Hotel Phone</th>
                                <th scope="col">Hotel Staff</th>
                                <th scope="col">Hotel Person Account Number</th>
                                <th scope="col">Amount Shipped</th>
                            </tr>
                        </thead>
                        @foreach ($hotels as $hotel)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/definitions/hotels/edit/'.$hotel->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        <li><a href="{{ url('/definitions/hotels/destroy/'.$hotel->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
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
                <h5 class="modal-title" id="exampleModalLabel">New Hotel</h5>
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
                                <label for="hotelName">Hotel Name</label>
                                <input type="text" class="form-control" id="hotelName" name="hotelName" placeholder="Enter Hotel Name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hotelPhone">Hotel Phone</label>
                                <input type="text" class="form-control" id="hotelPhone" name="hotelPhone" placeholder="Enter Hotel Phone">
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection