@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Forms</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Contact Forms</h2>
                        </div>
                        <div class="col-lg-6">
                            <button data-toggle="modal" data-target="#formModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Contact Form</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Name Surname</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Country</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        @foreach ($contact_forms as $contact_form)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/definitions/agents/edit/'.$contact_form->id) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        <li><a href="{{ url('/definitions/agents/destroy/'.$contact_form->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $contact_form->name_surname }}</td>
                            <td>{{ $contact_form->phone }}</td>
                            <td>{{ $contact_form->country }}</td>
                            <td>{{ $contact_form->email }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Contact Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/definitions/forms/store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name_surname">Name Surname</label>
                                <input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Enter Name Surname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone_get">Phone</label>
                                <input type="text" class="form-control" id="phone_get" name="customerPhone" placeholder="Enter Phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customerEmail">Email</label>
                                <input type="text" class="form-control" id="customerEmail" name="customerEmail" placeholder="Enter Email">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
