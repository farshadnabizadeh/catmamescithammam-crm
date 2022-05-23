@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Roles Operations</h2>
                        </div>
                        <div class="col-md-6">
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Role</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap dataTable" id="dataTable" data-table-source="" data-table-filter-target>
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Operation</th>
                        <th scope="col">Role ID</th>
                        <th scope="col">Role Name</th>
                        </tr>
                    </thead>
                    @foreach ($roles as $role)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/roles/edit/'.$role->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                    <li><a href="{{ url('/roles/clone/'.$role->id) }}" class="btn btn-warning edit-btn"><i class="fa fa-clone"></i> Clone Role</a></li>
                                    <li><a href="{{ url('/roles/delete/'.$role->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>{{ $role->id}}</td>
                        <td>{{ $role->name}}</td>
                    </tr>
                    @endforeach
               </table>
            </div>
            </div>
        </div>
    </div>
</div>

{{--
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Request Treatment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/definitions/requestTreatments/store') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="patient">Patient</label>
                            <select class="form-control" id="patients" name="patientId" required>
                                <option></option>
                                @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name_surname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="treatmentId">Treatment</label>
                            <select class="form-control" id="treatmentId" name="treatmentId" required>
                                <option></option>
                                @foreach ($treatments as $treatment)
                                <option value="{{ $treatment->id }}">{{ $treatment->treatment_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea class="form-control" id="note" name="note" placeholder="Note"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div> --}}

@endsection
