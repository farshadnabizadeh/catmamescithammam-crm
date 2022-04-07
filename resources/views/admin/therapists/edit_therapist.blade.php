@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Therapist</h2>
                    <p class="float-right last-user">Last Operation User: {{ $therapist->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/therapists/update/'.$therapist->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="therapistName">Therapist Name</label>
                                <input type="text" class="form-control" id="therapistName" name="therapistName" placeholder="Enter Therapist Name" value="{{ $therapist->therapist_name }}" required>
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
