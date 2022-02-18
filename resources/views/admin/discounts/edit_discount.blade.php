@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-5 mt-3">
                <div class="card-title">
                    <h2>Edit Discounts</h2>
                    <p class="float-right last-user">Last Operation User: {{ $discount->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/discounts/update/'.$discount->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountName">Discount Name</label>
                                <input type="text" class="form-control" id="discountName" name="discountName" placeholder="Enter Discount Name" value="{{ $discount->discount_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountCode">Discount Code</label>
                                <input type="text" class="form-control" id="discountCode" name="discountCode" placeholder="Enter Discount Code" value="{{ $discount->discount_code }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountPercentage">Discount Percentage</label>
                                <input type="text" class="form-control" id="discountPercentage" name="discountPercentage" placeholder="Enter Discount Percentage" value="{{ $discount->discount_percentage }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountNote">Discount Note</label>
                                <input type="text" class="form-control" id="discountNote" name="discountNote" placeholder="Enter Discount Note" value="{{ $discount->note }}">
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
