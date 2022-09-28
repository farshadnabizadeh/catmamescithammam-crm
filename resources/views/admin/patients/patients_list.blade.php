@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Patients List</li>
                </ol>
            </nav>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Patients List</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create patient')
                            <a href="{{ route('patient.create'); }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Patient</a>
                            @endcan
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    {!! $html->table() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
{!! $html->scripts() !!}

@endsection