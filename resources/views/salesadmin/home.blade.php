@extends('layouts.app')

@section('content')

@include('layouts.navbar')

        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-dark d-inline-block mb-0 item-text">Dashboard</h6>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col">
                                    <h5 class="card-title text-dashboard-card">Treatment Plans</h5>
                                    <hr>
                                    <a href="{{ route('treatmentplan.completed'); }}"><span class="h2 mb-0 count-card">{{ $treatmentPlanCount }}</span></a>
                                 </div>
                                 <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                       <i class="fa fa-files-o"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                     <div class="col">
                                        <h5 class="card-title text-dashboard-card">Patients</h5>
                                        <hr>
                                        <a href="{{ route('patient.index'); }}"><span class="h2 mb-0 count-card">{{ $patientCount }}</span></a>
                                     </div>
                                     <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                           <i class="fa fa-users"></i>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                     <div class="col">
                                        <h5 class="card-title text-dashboard-card">Users</h5>
                                        <hr>
                                        <a href="{{ route('user.index'); }}"><span class="h2 mb-0 count-card">{{ $userCount }}</span></a>
                                     </div>
                                     <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                           <i class="fa fa-user"></i>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0" style="padding: 0; padding-top: 15px">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">User Report</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 0">
                                <canvas id="pie-chart" width="800" height="450"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mx-auto">
                           <div class="card-header border-0" style="padding: 0; padding-top: 15px">
                              <div class="row align-items-center">
                                 <div class="col">
                                    <h3 class="mb-0">Treatment Report</h3>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body" style="padding: 0">
                              <canvas id="treatment-chart" width="800" height="450"></canvas>
                           </div>
                        </div>
                     </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-12 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-dashboard-card">Requested Treatment Plans of the day</h5>
                                    <hr>
                                    <span class="h2 mb-0 count-card">{{ $requestedTreatmentPlansTodayCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-dashboard-card">Total Requested Treatment Plans</h5>
                                    <hr>
                                    <span class="h2 mb-0 count-card">{{ $allRequestedTreatmentPlansCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-dashboard-card">Re Consult Requests of the day</h5>
                                    <hr>
                                    <span class="h2 mb-0 count-card">{{ $reConsultTodayCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="fa fa-arrows-h"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-dashboard-card">Re Consult Requests</h5>
                                    <hr>
                                    <span class="h2 mb-0 count-card">{{ $reConsultCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="fa fa-arrows-h"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-12 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-dashboard-card">Completed Treatment Plans of the day</h5>
                                    <hr>
                                    <span class="h2 mb-0 count-card">{{ $completedTreatmentPlansTodayCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-dashboard-card">Total Completed Treatment Plans</h5>
                                    <hr>
                                    <span class="h2 mb-0 count-card">{{ $allCompletedTreatmentPlansCount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <div class="card p-4 mt-3">
                        <div class="card-title">
                            <h2>Requested Treatment Plans of the day</h2>
                            <hr>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Operation</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Patient</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Treatment</th>
                                        <th scope="col">Sales Person</th>
                                    </tr>
                                </thead>
                                @foreach ($requested_treatment_plans as $requested_treatment_plan)
                                    <tr>
                                        <td>
                                            <a href="{{ route('treatmentplan.edit', ['id' => $requested_treatment_plan->id]) }}" class="btn btn-danger treatmentplan-next-btn">Complete TP <i class="fa fa-chevron-right"></i></a>
                                        </td>
                                        <td>{{ date('ymd', strtotime($requested_treatment_plan->created_at)) . $requested_treatment_plan->patient->id . $requested_treatment_plan->id }}</td>
                                        <td><span class="badge badge-danger">{{ $requested_treatment_plan->status->name }}</span></td>
                                        <td>{{ $requested_treatment_plan->patient->name_surname }}</td>
                                        <td>{{ $requested_treatment_plan->patient->age }}</td>
                                        <td>{{ $requested_treatment_plan->treatment->name_en }}</td>
                                        <td>{{ $requested_treatment_plan->salesPerson->name_surname }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 table-responsive">
                    <div class="card p-4 mt-3">
                        <div class="card-title">
                            <h2>Re Consults Plans of the day</h2>
                            <hr>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap dataTable" id="tableReconsult">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Operation</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Patient</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Treatment</th>
                                        <th scope="col">Sales Person</th>
                                    </tr>
                                </thead>
                                @foreach ($reconsult_treatment_plans as $reconsult_treatment_plan)
                                    <tr>
                                        <td>
                                            <a href="{{ route('treatmentplan.edit', ['id' => $reconsult_treatment_plan->id]) }}" class="btn btn-danger treatmentplan-next-btn">Complete TP <i class="fa fa-chevron-right"></i></a>
                                        </td>
                                        <td>{{ date('ymd', strtotime($reconsult_treatment_plan->created_at)) . $reconsult_treatment_plan->patient->id . $reconsult_treatment_plan->id }}</td>
                                        <td><span class="badge badge-danger">{{ $reconsult_treatment_plan->status->status_name }}</span></td>
                                        <td>{{ $reconsult_treatment_plan->patient->name_surname }}</td>
                                        <td>{{ $reconsult_treatment_plan->patient->age }}</td>
                                        <td>{{ $reconsult_treatment_plan->treatment->name_en }}</td>
                                        <td>{{ $reconsult_treatment_plan->salesPerson->name_surname }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 table-responsive">
                    <div class="card p-4 mt-3">
                        <div class="card-title">
                            <h2>Completed Treatment Plans of the day</h2>
                            <hr>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap dataTable" id="tableCompleted">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Operation</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Sales Person</th>
                                </tr>
                                </thead>
                                @foreach ($completed_treatment_plans as $completed_treatment_plan)
                                    <tr>
                                        <td>
                                            <a href="{{ route('treatmentplan.edit', ['id' => $completed_treatment_plan]) }}" class="btn btn-success treatmentplan-next-btn">Update TP <i class="fa fa-chevron-right"></i></a>
                                        </td>
                                        <td>{{ date('ymd', strtotime($completed_treatment_plan->created_at)) . $completed_treatment_plan->patient->id . $completed_treatment_plan->id }}</td>
                                        <td><span class="badge badge-success">{{ $completed_treatment_plan->status->name }}</span></td>
                                        <td>{{ $completed_treatment_plan->patient->name_surname }}</td>
                                        <td>{{ $completed_treatment_plan->patient->age }}</td>
                                        <td>{{ $completed_treatment_plan->treatment->name_en }}</td>
                                        <td>{{ $completed_treatment_plan->salesPerson->name_surname }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection