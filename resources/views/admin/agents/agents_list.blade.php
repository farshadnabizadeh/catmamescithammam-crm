@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agents</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Agents List</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create agent')
                            <button data-toggle="modal" data-target="#agentModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Agent</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">Agent Name</th>
                                <th scope="col">Agent Phone</th>
                                <th scope="col">Agent Country</th>
                                <th scope="col">Agent City</th>
                                <th scope="col">Agent Address</th>
                                <th scope="col">Agent Email</th>
                            </tr>
                        </thead>
                        @foreach ($agents as $agent)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        @can('edit agent')
                                        <li><a href="{{ route('agent.edit', ['id' => $agent->id]) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                        @endcan
                                        @can('delete agent')
                                        <li><a href="{{ route('agent.destroy', ['id' => $agent->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->phone }}</td>
                            <td>{{ $agent->country}}</td>
                            <td>{{ $agent->city }}</td>
                            <td>{{ $agent->address }}</td>
                            <td>{{ $agent->email }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agent.store') }}" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Agent Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Agent Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Agent Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Agent Phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="countryId">Agent Country</label>
                                <select name="country" class="countries form-control" id="countryId">
                                    <option></option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Agent Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Agent Email">
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
