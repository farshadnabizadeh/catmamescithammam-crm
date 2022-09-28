@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Treatment Plan Status</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $treatment_plan_status->user->name }}</p>
                </div>
                <form action="{{ route('treatmentplanstatus.update', ['id' => $treatment_plan_status->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Treatment Plan Status Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Treatment Plan Status Name" value="{{ $treatment_plan_status->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="color">Treatment Plan Status Color</label>
                                <input type="text" class="form-control" id="color" data-jscolor="{}" name="color" placeholder="Enter Treatment Plan Status Color" value="{{ $treatment_plan_status->color }}" required>
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
