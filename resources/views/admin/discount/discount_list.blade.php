@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Discounts</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Discounts</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create discount')
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Discount</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Operation</th>
                        <th scope="col">Discount Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">Note</th>
                        </tr>
                    </thead>
                    @foreach ($discounts as $discount)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    @can('edit discount')
                                    <li><a href="{{ route('discount.edit', ['id' => $discount->id]) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                    @endcan
                                    @can('delete discount')
                                    <li><a href="{{ route('discount.destroy', ['id' => $discount->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </td>
                        <td>{{ $discount->name }}</td>
                        <td>{{ $discount->amount }}</td>
                        <td>{{ $discount->percentage }}</td>
                        <td>{{ $discount->note }}</td>
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
          <h5 class="modal-title" id="exampleModalLabel">New Discount</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('discount.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Discount Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Discount Name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="percentage">Percentage</label>
                            <input type="number" class="form-control" id="percentage" name="percentage" placeholder="Enter Percentage">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="note">Note</label>
                            <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note" required>
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
