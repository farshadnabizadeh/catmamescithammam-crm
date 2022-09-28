@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">General Reports</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>General Reports</h2>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="dataTable" data-table-source="" data-table-filter-target>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Treatment Plan Count</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach($data as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->aCount}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
