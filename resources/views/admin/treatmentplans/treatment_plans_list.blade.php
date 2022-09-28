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
                            <h2>Treatment Plans</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create treatment plan')
                            <a href="{{ route('treatmentplan.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Request</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    {!! $html->table() !!}
               </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ticketReceived" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" id="treatmentPlanId">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="treatmentPlanName">Arrival Date</label>
                                <input type="text" class="form-control" id="arrivalDate" name="arrivalDate" autocomplete="off" placeholder="Enter Arrival Date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="operationDate">Operation Date</label>
                                <input type="text" class="form-control" id="operationDate" name="operationDate" placeholder="Enter Operation Date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="departureDate">Departure Date</label>
                                <input type="text" class="form-control" id="departureDate" name="departureDate" placeholder="Enter Departure Date">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-right mt-3" id="updateTicket">Save <i class="fa fa-check"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
{!! $html->scripts() !!}

@endsection