@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="filterTreatment" class="filterLabel">Treatment</label>
                            <select id="filterTreatment">
                                <option value=""></option>
                                @foreach ($treatments as $treatment)
                                <option value="{{ $treatment->name_en }}">{{ $treatment->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-4">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>{{ $tableTitle }}</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create treatmentplan')
                            <a href="{{ route('treatmentplan.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Request</a>
                            @endcan
                        </div>
                    </div>
                    <div class="row mt-3">

                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Operation</th>
                                <th scope="col">ID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Is Suitable</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Treatment</th>
                                <th scope="col">Price</th>
                                <th scope="col">Sales Person</th>
                                <th scope="col">Alcohol</th>
                                <th scope="col">Smoking</th>
                            </tr>
                        </thead>
                        @foreach ($listAllByDates as $listAllByDate)
                            <tr>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            @can('edit treatmentplan')
                                            <li><a href="{{ route('treatmentplan.edit', ['id' => $listAllByDate->tId]) }}" class="btn btn-info edit-btn"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                            @endcan
                                            @can('delete treatmentplan')
                                            <li><a href="{{ route('treatmentplan.destroy', ['id' => $listAllByDaten->tId]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                            @endcan
                                            <li>
                                                <a href="{{ route('treatmentplan.edit', ['id' => $listAllByDate->tId]) }}" class="btn btn-primary edit-btn">View Doctor Result <i class="fa fa-arrow-right"></i></a>
                                            </li>
                                            <li><a href="{{ url('/treatmentplans/download/'.$listAllByDate->tId.'?lang=en&theme=1') }}" class="btn btn-success edit-btn"><i class="fa fa-download"></i> Download</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ date('ymd', strtotime($listAllByDate->date)) . $listAllByDate->patient_id . $listAllByDate->id }}</td>
                                <td style="background-color: {{ $listAllByDate->color }}; color: #fff">{{ $listAllByDate->name }}</td>
                                <td>
                                    @if($listAllByDate->is_suitable == 1)
                                    <p class="text-center"><i class="fa fa-check check-icon"></i></p>
                                    @elseif($listAllByDate->is_suitable == 0)
                                    <p class="text-center"><i class="fa fa-times non-icon"></i></p>
                                    @else
                                    @endif
                                </td>
                                <td><a href="{{ url('/patients/edit/'.$listAllByDate->patient_id) }}">{{ $listAllByDate->Pname }}</a></td>
                                <td>{{ $listAllByDate->name_en }}</td>
                                <td>{{ $listAllByDate->price_currency }} {{ $listAllByDate->total_price }}</td>
                                <td>{{ $listAllByDate->salesName }}</td>
                                <td>@if($listAllByDate->is_alcohol == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                                <td>@if($listAllByDate->is_smoking == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                            </tr>
                        @endforeach
                    </table>
               </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ticketReceived" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST">
                @csrf
                <input type="hidden" id="current_treatment_plan_id">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="treatmentPlanName">Arrival Date</label>
                            <input type="text" class="form-control" id="arrivalDate" name="arrivalDate" autocomplete="off" placeholder="Enter Arrival Date">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="departureDate">Departure Date</label>
                            <input type="text" class="form-control" id="departureDate" name="departureDate" placeholder="Enter Departure Date">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="operationDate">Operation Date</label>
                            <input type="text" class="form-control" id="operationDate" name="operationDate" placeholder="Enter Operation Date">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary float-right mt-3" id="updateTicket">Save <i class="fa fa-check"></i></button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

@endsection
