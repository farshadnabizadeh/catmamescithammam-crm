@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        @include("layouts.head_box")
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Requested Treatment Plans</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create treatment plan')
                            <a href="{{ route('treatmentplan.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Request</a>
                            @endcan
                        </div>
                    </div>
                    <div class="row mt-3">
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