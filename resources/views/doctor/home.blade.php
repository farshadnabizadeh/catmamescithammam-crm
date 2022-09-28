@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
   <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0 item-text">Arayüz</h6>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-dashboard-card">Bugün Cevaplanmayan Tedavi Planları</h5>
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
            <div class="col-xl-6 col-md-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-dashboard-card">Toplam Cevaplanmayan Tedavi Planları</h5>
                                <hr>
                                <a href="{{ route('treatmentplan.requested') }}">
                                    <span class="h2 mb-0 count-card">{{ $allRequestedTreatmentPlansCount }}</span>
                                </a>
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
            <div class="col-xl-6 col-md-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-dashboard-card">Bugün Yeniden Danışılan Planları</h5>
                                <hr>
                                <span class="h2 mb-0 count-card">{{ $reconsultTodayCount }}</span>
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
            <div class="col-xl-6 col-md-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-dashboard-card">Toplam Yeniden Danışılan Tedavi Planları</h5>
                                <hr>
                                <a href="{{ route('treatmentplan.reconsult') }}">
                                    <span class="h2 mb-0 count-card">{{ $allReConsultCount }}</span>
                                </a>
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
            <div class="col-xl-6 col-md-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-dashboard-card">Bugün Tamamlanan Tedavi Planları</h5>
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
            <div class="col-xl-6 col-md-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-dashboard-card">Toplam Cevaplanan Tedavi Planları</h5>
                                <hr>
                                <a href="{{ route('treatmentplan.completed') }}">
                                    <span class="h2 mb-0 count-card">{{ $allCompletedTreatmentPlansCount }}</span>
                                </a>
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
            <div class="card p-4">
                <div class="card-title">
                    <h2>Bugün Cevaplanmayan Tedavi Planları</h2>
                    <hr>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">İşlem</th>
                                <th scope="col">ID</th>
                                <th scope="col">Durum</th>
                                <th scope="col">Hasta</th>
                                <th scope="col">Yaş</th>
                                <th scope="col">İstenilen Tedavi</th>
                                <th scope="col">Alkol</th>
                                <th scope="col">Sigara</th>
                            </tr>
                        </thead>
                        @foreach ($requested_treatment_plans as $requested_treatment_plan)
                            <tr>
                                <td>
                                    <a href="{{ route('treatmentplan.edit', ['id' => $requested_treatment_plan->id]) }}" class="btn btn-danger treatmentplan-next-btn">Cevapla <i class="fa fa-chevron-right"></i></a>
                                </td>
                                <td>{{ $requested_treatment_plan->created_at->format('ymd') }}{{ $requested_treatment_plan->patient->id }}{{ $requested_treatment_plan->id }}</td>
                                <td style="background-color: {{ $requested_treatment_plan->status->color }}; color: #fff">{{ $requested_treatment_plan->status->name }}</td>
                                <td>{{ $requested_treatment_plan->patient->name_surname }}</td>
                                <td>{{ $requested_treatment_plan->patient->age }}</td>
                                <td>{{ $requested_treatment_plan->treatment->name_en }}</td>
                                <td>@if($requested_treatment_plan->is_alcohol == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                                <td>@if($requested_treatment_plan->is_smoke == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 table-responsive">
            <div class="card p-4">
                <div class="card-title">
                    <h2>Bugün Danışılan Tedavi Planları</h2>
                    <hr>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableReconsult">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">İşlem</th>
                                <th scope="col">ID</th>
                                <th scope="col">Durum</th>
                                <th scope="col">Hasta</th>
                                <th scope="col">Yaş</th>
                                <th scope="col">İstenilen Tedavi</th>
                                <th scope="col">Alkol</th>
                                <th scope="col">Sigara</th>
                            </tr>
                        </thead>
                        @foreach ($reconsult_treatment_plans as $reconsult_treatment_plan)
                            <tr>
                                <td>
                                    <a href="{{ route('treatmentplan.edit', ['id' => $reconsult_treatment_plan->id]) }}" class="btn btn-warning treatmentplan-next-btn">Cevapla <i class="fa fa-chevron-right"></i></a>
                                </td>
                                <td>{{ $reconsult_treatment_plan->created_at->format('ymd') }}{{ $reconsult_treatment_plan->patient->id }}{{ $reconsult_treatment_plan->id }}</td>
                                <td style="background-color: {{ $reconsult_treatment_plan->status->color }}; color: #fff">{{ $reconsult_treatment_plan->status->name }}</td>
                                <td>{{ $reconsult_treatment_plan->patient->name_surname }}</td>
                                <td>{{ $reconsult_treatment_plan->patient->age }}</td>
                                <td>{{ $reconsult_treatment_plan->treatment->name_en }}</td>
                                <td>@if($reconsult_treatment_plan->is_alcohol == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                                <td>@if($reconsult_treatment_plan->is_smoke == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 table-responsive">
            <div class="card p-4">
                <div class="card-title">
                    <h2>Bugün Cevaplanan Tedavi Planları</h2>
                    <hr>
                </div>
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap dataTable" id="tableCompleted">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">İşlem</th>
                                <th scope="col">ID</th>
                                <th scope="col">Durum</th>
                                <th scope="col">Hasta</th>
                                <th scope="col">Yaş</th>
                                <th scope="col">İstenilen Tedavi</th>
                                <th scope="col">Alkol</th>
                                <th scope="col">Sigara</th>
                            </tr>
                        </thead>
                        @foreach ($completed_treatment_plans as $completed_treatment_plan)
                            <tr>
                                <td>
                                    <a href="{{ route('treatmentplan.edit', ['id' => $completed_treatment_plan->id]) }}" class="btn btn-success treatmentplan-next-btn">Güncelle <i class="fa fa-chevron-right"></i></a>
                                </td>
                                <td>{{ $completed_treatment_plan->created_at->format('ymd') }}{{ $completed_treatment_plan->patient->id }}{{ $completed_treatment_plan->id }}</td>
                                <td style="background-color: {{ $completed_treatment_plan->status->color }}; color: #fff">{{ $completed_treatment_plan->status->name }}</td>
                                <td>{{ $completed_treatment_plan->patient->name_surname }}</td>
                                <td>{{ $completed_treatment_plan->patient->age }}</td>
                                <td>{{ $completed_treatment_plan->treatment->name_en}}</td>
                                <td>@if($completed_treatment_plan->is_alcohol == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                                <td>@if($completed_treatment_plan->is_smoke == "yes") <i class="fa fa-check check-icon"></i> @else <i class="fa fa-times non-icon"></i> @endif</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
