@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Agent</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $agent->user->name }}</p>
                </div>
                <form action="{{ route('agent.update', ['id' => $agent->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Agent Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Agent Name" value="{{ $agent->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Agent Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Agent Phone" value="{{ $agent->phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="country">Agent Country</label>
                                <select name="country" class="countries form-control countryData" id="countryId">
                                    <option value="{{ $agent->country }}" selected>{{ $agent->country }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Agent Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Agent Email" value="{{ $agent->email }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
