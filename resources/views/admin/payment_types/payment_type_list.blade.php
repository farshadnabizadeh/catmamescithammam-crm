@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 table-responsive">
         <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
               <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Payments</li>
            </ol>
         </nav>
         <div class="card p-3 mt-3">
            <div class="card-title">
               <div class="row">
                  <div class="col-lg-6">
                     <h2>Payment Type Lists</h2>
                  </div>
                  <div class="col-lg-6">
                     <button data-toggle="modal" data-target="#createPaymentTypeModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Payment Type</button>
                  </div>
               </div>
            </div>
            <div class="dt-responsive table-responsive">
               <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col">Operation</th>
                        <th scope="col">Payment Type</th>
                     </tr>
                  </thead>
                  @foreach ($payment_types as $payment_type)
                  <tr>
                     <td>
                        <div class="dropdown">
                           <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                              <li><a href="{{ url('/definitions/payment_types/edit/'.$payment_type->id) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                              <li><a href="{{ url('/definitions/payment_types/destroy/'.$payment_type->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                           </ul>
                        </div>
                     </td>
                     <td>{{ $payment_type->payment_type_name }}</td>
                  </tr>
                  @endforeach
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="createPaymentTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Payment Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ url('/definitions/payment_types/store') }}" method="POST">
               @csrf
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="paymentTypeName">Payment Type Name</label>
                        <input type="text" class="form-control" id="paymentTypeName" name="paymentTypeName" placeholder="Enter Payment Type Name" required>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="note">Note</label>
                        <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note">
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