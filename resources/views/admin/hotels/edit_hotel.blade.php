@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Edit Hotel</h3>
                    <p class="float-right last-user">Last Operation User: {{ $hotel->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/hotels/update/'.$hotel->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelName">Hotel Name</label>
                                <input type="text" class="form-control" id="hotelName" name="hotelName" placeholder="Enter Hotel Name" value="{{ $hotel->hotel_name }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelPhone">Hotel Phone</label>
                                <input type="text" class="form-control" id="hotelPhone" name="hotelPhone" placeholder="Enter Hotel Phone" value="{{ $hotel->hotel_phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelPerson">Hotel Person</label>
                                <input type="text" class="form-control" id="hotelPerson" name="hotelPerson" placeholder="Enter Hotel Person" value="{{ $hotel->hotel_person }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelPersonAccountNumber">Hotel Person Account Number</label>
                                <input type="text" class="form-control" id="hotelPersonAccountNumber" name="hotelPersonAccountNumber" placeholder="Enter Hotel Person Account Number" value="{{ $hotel->hotel_person_account_number }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelPersonSendAmount">Hotel Person Send Amount</label>
                                <input type="text" class="form-control" id="hotelPersonSendAmount" name="hotelPersonSendAmount" placeholder="Enter Hotel Person Send Amount" value="{{ $hotel->hotel_person_send_amount }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
