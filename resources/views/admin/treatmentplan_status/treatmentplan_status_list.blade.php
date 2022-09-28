@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Treatment Plan Status</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Treatment Plan Status</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create treatment plan status')
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Treatment Plan Status</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Operation</th>
                            <th scope="col">Status Name</th>
                            <th scope="col">Status Color</th>
                        </tr>
                    </thead>
                    @foreach ($treatment_plan_statuses as $treatment_plan_status)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    @can('edit treatment plan status')
                                    <li><a href="{{ route('treatmentplanstatus.edit', ['id' => $treatment_plan_status->id]) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                    @endcan
                                    <li><a href="{{ route('treatmentplanstatus.destroy', ['id' => $treatment_plan_status->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>{{ $treatment_plan_status->name }}</td>
                        <td style="background-color: {{ $treatment_plan_status->color }}"></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Treatment Plan Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treatmentplanstatus.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Status Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Status Name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="color">Status Color</label>
                            <input type="text" class="form-control" id="color" value="#0043FFFF" data-jscolor="{}" name="color" placeholder="Enter Status Color" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Save <i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

@endsection
