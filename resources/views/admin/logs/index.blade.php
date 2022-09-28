@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 table-responsive">
         <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
               <li class="breadcrumb-item home-page"><a href="{{ url('/home') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">User Activities</li>
            </ol>
         </nav>
         <div class="card p-4 mt-3">
            <div class="card-title">
                <div class="row">
                    <div class="col-md-6">
                        <h2>User Activities</h2>
                    </div>
                </div>
            </div>
            <div class="dt-responsive table-responsive">
                <table id="tableData" class="table table-bordered table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Action</th>
                            <th>User</th>
                            <th>Time</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                            <th>Url</th>
                            <th>Ip_adrress</th>
                            <th>User Agent</th>
                        </tr>
                    </thead>
                    <tbody id="audits">
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->event }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td> {{ date('d-m-Y h:i:s', strtotime($log->created_at)) }}</td>
                                <td>
                                    @foreach($log->old_values as $attribute  => $value)
                                    <b>{{ $attribute }}</b>
                                    <b>{{ $value }}</b>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($log->new_values as $attribute  => $value)
                                    <b>{{ $attribute }}</b>
                                    <b>{{ $value }}</b>
                                    @endforeach
                                </td>
                                <td>{{ $log->url }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->user_agent }}</td>
                            </tr>
                        @endforeach
                    </tbody>                
                </table>
         </div>
         </div>
      </div>
   </div>
</div>


@endsection
