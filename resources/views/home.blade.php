@extends('layouts.app')
@section('content')
@include('layouts.navbar')

<div class="header bg-primary pb-6">
<div class="container-fluid">
    <div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0 item-text font-weight-600">Dashboard </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-dashboard-card">Customers</h5>
                            <hr>
                            <a href="{{ url('/definitions/customers') }}">
                                <span class="h2 mb-0 count-card">{{ $customerCount }}</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-dashboard-card">Hotels</h5>
                            <hr>
                            <a href="{{ url('/definitions/hotels') }}">
                                <span class="h2 mb-0 count-card">{{ $hotelCount }}</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-dashboard-card">Services</h5>
                            <hr>
                            <a href="{{ url('/definitions/services') }}">
                                <span class="h2 mb-0 count-card">{{ $serviceCount }}</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fa fa-sun-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-dashboard-card">Therapists</h5>
                            <hr>
                            <a href="{{ url('/definitions/therapists') }}">
                                <span class="h2 mb-0 count-card">{{ $therapistCount }}</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Last 5 Customers</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/definitions/customers') }}" class="btn btn-sm btn-danger">See all</a>
                    </div>
                </div>
                </div>
                <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lastCustomers as $lastCustomer)
                        <tr>
                            <td>{{ $lastCustomer->customer_name }}</td>
                            <td>{{ $lastCustomer->customer_phone }}</td>
                            <td>{{ $lastCustomer->customer_country }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
         <div class="card">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">General Summary</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <canvas id="pie-chart" width="800" height="450"></canvas>
            </div>
         </div>
      </div>
    </div>
</div>

@endsection