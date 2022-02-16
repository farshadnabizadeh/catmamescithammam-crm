@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-5 mt-3">
                <div class="card-title">
                    <h2>Edit Source</h2>
                    {{-- <p class="float-right last-user">Last Operation User: {{ $source->name }}</p> --}}
                </div>
                <form action="{{ url('/definitions/sources/update/'.$source->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sourceName">Source Name</label>
                                <input type="text" class="form-control" id="sourceName" name="sourceName" placeholder="Enter Source Name" value="{{ $source->source_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sourceColor">Source Color</label>
                                <input type="text" class="form-control" id="colorpicker" name="sourceColor" placeholder="Enter Source Color" value="{{ $source->source_color }}" required>
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
