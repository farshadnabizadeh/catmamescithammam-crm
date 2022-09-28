@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mt-3" onclick="previousPage();"> <i class="fa fa-chevron-left"></i> Previous Page </button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Patient</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $patient->user->name }} </p>
                </div>
                    <form action="{{ route('patient.update', ['id' => $patient->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="leadSourceId">Lead Source</label>
                                    <select class="form-control" id="leadSourceId" name="leadSourceId">
                                        <option value="{{ $patient->lead_source_id }}" selected>{{ $patient->leadSource->name }}</option>
                                        @foreach ($lead_sources as $lead_source)
                                        <option value="{{ $lead_source->id }}">{{ $lead_source->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="name">Patient Name Surname</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Patient Name" value="{{ $patient->name_surname }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Patient Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Patient Phone" value="{{ $patient->phone_number }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="age">Patient Age</label>
                                    <input type="text" class="form-control" id="age" name="age" maxlength="2" placeholder="Enter Patient Age" value="{{ $patient->age }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">        
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="countryId">Patient Country</label>
                                    <select class="form-control" name="countryId" id="patientCountry">
                                        <option value="{{ $patient->country->id }}" @selected(true)>{{ $patient->country->name }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="email">Patient Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Patient Email" value="{{ $patient->email_address }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <label>Gender</label>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="Male" name="gender" id="male" {{ ($patient->gender == "Male")? "checked" : "" }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" value="Female" name="gender" id="female" {{ ($patient->gender == "Female")? "checked" : "" }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note" value="{{ $patient->note }}">
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs mt-3 d-flex" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="active-tp-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Active Treatment Plans</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cancel-tp-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Archived Treatment Plans</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="active-tp-tab">
                                <div class="col-lg-12">
                                    <div class="card h-100 mt-3">
                                        <div class="card-body">
                                            <h3 class="d-flex align-items-center mb-3">Active Treatment Plans</h3>
                                            @can('create treatmentplan')
                                            <a href="{{ route('treatmentplan.create') }}" class="btn btn-primary float-right add-new-btn"> <i class="fa fa-plus"></i> Create New Request</a>
                                            @endcan
                                            <div class="dt-responsive table-responsive">
                                                <table class="table table-striped table-bordered nowrap dataTable" id="dataTable">
                                                    <thead class="thead-light">
                                                        <th scope="col">Operation</th>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Is Suitable</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Patient</th>
                                                        <th scope="col">Treatment</th>
                                                        <th scope="col">Sales Person</th>
                                                        <th scope="col">Height</th>
                                                        <th scope="col">Weight</th>
                                                        <th scope="col">Alcohol</th>
                                                        <th scope="col">Smoke</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($patient->treatmentPlans as $dataTP)
                                                        <tr>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu">
                                                                        @can('edit treatment plan')
                                                                        <li>
                                                                            <a href="{{ route('treatmentplan.edit', ['id' => $dataTP->id]) }}" class="btn btn-info edit-btn"> <i class="fa fa-pencil-square-o"></i> Edit / Show</a>
                                                                        </li>
                                                                        @endcan
                                                                        @can('delete treatment plan')
                                                                        <li>
                                                                            <a href="{{ route('treatmentplan.destroy', ['id' => $dataTP->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"> <i class="fa fa-trash"></i> Delete</a>
                                                                        </li>
                                                                        @endcan
                                                                        @if($dataTP->status->id == 1 || $dataTP->status->id == 3)
                                                                        @else
                                                                        @can('download treatment plan')
                                                                        <li>
                                                                            <a href="{{ url('/treatmentplans/download/'.$dataTP->id.'?lang=en&theme=1') }}" class="btn btn-success edit-btn"> <i class="fa fa-download"></i> Download</a>
                                                                        </li>
                                                                        @endcan
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td>{{ date('ymd', strtotime($dataTP->created_at)) . $dataTP->patient->id . $dataTP->id  }}</td>
                                                            <td>@if($dataTP->is_suitable == 1) <i class="fa fa-check check-icon"></i> @elseif($dataTP->is_suitable == 0) @else <i class="fa fa-times non-icon"></i>  @endif</td>
                                                            <td>
                                                                @if($dataTP->arrival_date != null)
                                                                Ticket Received <i class="fa fa-ticket check-icon"></i>
                                                                @elseif($dataTP->status->id == 1)
                                                                <span class="badge badge-danger">{{ $dataTP->status->name }}</span>
                                                                @elseif($dataTP->status->id == 2)
                                                                <span class="badge badge-success">{{ $dataTP->status->name }}</span>
                                                                @elseif($dataTP->status->id == 3)
                                                                <span class="badge badge-warning">{{ $dataTP->status->name }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('patient.edit', ['id' => $dataTP->patient->id]) }}">{{ $dataTP->patient->name_surname }}</a>
                                                            </td>
                                                            <td>{{ $dataTP->treatment->name_en }}</td>
                                                            <td>{{ $dataTP->salesPerson->name_surname }}</td>
                                                            <td>{{ $dataTP->height }} {{ $dataTP->height_unit }}</td>
                                                            <td>{{ $dataTP->weight }} {{ $dataTP->weight_unit }}</td>
                                                            <td>@if($dataTP->is_alcohol == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif </td>
                                                            <td>@if($dataTP->is_smoke == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="cancel-tp-tab">
                                @foreach ($patient->treatmentPlans as $dataTP)
                                    @if(!empty($dataTP->deleted_at))
                                    <h3>{{ $dataTP->height_unit }}</h3>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right update-btn" id="updatePatientBtn">Update <i class="fa fa-check"></i> </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
