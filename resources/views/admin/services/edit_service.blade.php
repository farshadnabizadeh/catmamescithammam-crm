@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-5 mt-3">
                <div class="card-title">
                    <h2>Edit Service</h2>
                    {{-- <p class="float-right last-user">Last Operation User: {{ $source->name }}</p> --}}
                </div>
                <form action="{{ url('/definitions/services/update/'.$service->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceName">Service Name</label>
                                <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="Enter Service Name" value="{{ $service->service_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCurrency">Service Currency</label>
                                <select id="serviceCurrency" name="serviceCurrency" class="form-control" required>
                                    <option value="{{ $service->service_currency }}" selected>{{ $service->service_currency }}</option>
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
                                <input type="text" class="form-control" id="serviceCost" name="serviceCost" placeholder="Enter Service Cost" value="{{ $service->service_cost }}" required>
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
