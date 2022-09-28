@extends('layouts.app')
@section('content')
@include('layouts.navbar')

<div class="header pb-6">
   <div class="container-fluid">
      <div class="header-body">
         <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
               <h6 class="h2 text-dark d-inline-block mb-0 item-text">Dashboard </h6>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-4 col-md-6">
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
            <div class="col-xl-4 col-md-6">
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
            <div class="col-xl-4 col-md-6">
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
         </div>
      </div>
   <div>

   <div class="row">
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
   </div>
</div>

@endsection
