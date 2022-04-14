@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Customer</h2>
                    <p class="float-right last-user">Last Operation User: {{ $customer->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/customers/update/'.$customer->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerName">Customer Name</label>
                                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Enter Customer Name" value="{{ $customer->customer_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerPhone">Customer Phone</label>
                                <input type="text" class="form-control" id="phone_get" name="customerPhone" placeholder="Enter Customer Phone" value="{{ $customer->customer_phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerCountry">Customer Country</label>
                                <input type="text" class="form-control" id="country_get" name="customerCountry" placeholder="Enter Customer Country" value="{{ $customer->customer_country }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerEmail">Customer Email</label>
                                <input type="text" class="form-control" id="customerEmail" name="customerEmail" placeholder="Enter Customer Email" value="{{ $customer->customer_email }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerSobId">Source Of Booking</label>
                                <select id="customerSobId" name="customerSobId" class="form-control" required>
                                    <option value="{{ $customer->sob->id }}" @selected(true)>{{ $customer->sob->source_name }}</option>
                                    @foreach ($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->source_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>  
                    <button type="submit" class="btn btn-success mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
