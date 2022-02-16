@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <div class="card p-5 mt-3">
                <div class="card-title">
                    <h2>Source Of Booking Lists</h2>
                    <button data-toggle="modal" data-target="#customerModal" class="btn btn-success float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Source Of Booking</button>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Source Name</th>
                                <th scope="col">Source Color</th>
                            </tr>
                        </thead>
                        @foreach ($sources as $source)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/definitions/sources/edit/'.$source->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        <li><a href="{{ url('/definitions/sources/destroy/'.$source->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $source->source_name }}</td>
                            <td style="background-color: {{ $source->source_color }}"></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Source Of Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/definitions/sources/store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sourceName">Source Name</label>
                                <input type="text" class="form-control" id="sourceName" name="sourceName" placeholder="Enter Source Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sourceColor">Source Color</label>
                                <input type="text" class="form-control" id="colorpicker" value='#276cb8' name="sourceColor" placeholder="Enter Source Color">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right" id="saveCustomerBtn">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
