@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Medical Sub Department</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Medical Sub Departments</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create medical sub department')
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Medical Sub Department</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="dataTable" data-table-source="" data-table-filter-target>
                        <thead class="thead-light">
                            <tr>
                                <th class="table-topper">Operation</th>
                                <th class="table-topper">Medical Sub Department</th>
                                <th class="table-topper">Medical Department</th>
                            </tr>
                        </thead>
                        @foreach ($medical_sub_departments as $medical_sub_department)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        @can('edit medical sub department')
                                        <li><a href="{{ route('medicalsubdepartment.edit', ['id' => $medical_sub_department->id]) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        @endcan
                                        @can('delete medical sub department')
                                        <li><a href="{{ route('medicalsubdepartment.destroy', ['id' => $medical_sub_department->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $medical_sub_department->name }}</td>
                            <td>{{ $medical_sub_department->parentDepartment->name }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Medical Sub Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('medicalsubdepartment.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Medical Sub Department Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Medical Sub Department Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="medicalDepartmentId">Medical Department</label>
                                <select class="form-control" name="departmentId" id="medicalDepartmentId" required>
                                    <option value="" selected disabled>Select a Medical Department</option>
                                    @foreach ($medical_departments as $medical_department)
                                    <option value="{{ $medical_department->id }}">{{ $medical_department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
