@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-5 mt-3">
                <div class="card-title">
                    <h2>Edit Discount</h2>
                    <p class="float-right last-user">Last Operation User: {{ $discount->name }}</p>
                </div>
                <form action="{{ url('/definitions/discount/update/'.$discount->id) }}" method="POST">
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
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{ $discount->amount }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="percentage">Percentage</label>
                                <input type="text" class="form-control" id="percentage" name="percentage" placeholder="Enter Percentage" value="{{ $discount->percentage }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note" value="{{ $discount->note }}" required>
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
