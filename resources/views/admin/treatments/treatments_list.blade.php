@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
   <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Treatments</li>
                </ol>
            </nav>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Treatments</h2>
                        </div>
                        <div class="col-md-6">
                            @can('create treatment')
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> New Treatment</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap dataTable" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="table-topper">Operation</th>
                            <th class="table-topper">EN</th>
                            <th class="table-topper">DE</th>
                            <th class="table-topper">FR</th>
                            <th class="table-topper">IT</th>
                            <th class="table-topper">ES</th>
                            <th class="table-topper">PT</th>
                            <th class="table-topper">PL</th>
                            <th class="table-topper">RU</th>
                            <th class="table-topper">TR</th>
                            <th class="table-topper">AR</th>
                        </tr>
                    </thead>
                    @foreach ($treatments as $treatment)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    @can('edit treatment')
                                    <li><a href="{{ route('treatment.edit', ['id' => $treatment->id]) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Edit / Show</a></li>
                                    @endcan
                                    @can('delete treatment')
                                    <li><a href="{{ route('treatment.destroy', ['id' => $treatment->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Delete</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </td>
                        <td>{{ $treatment->name_en }}</td>
                        <td>{{ $treatment->name_de }}</td>
                        <td>{{ $treatment->name_fr }}</td>
                        <td>{{ $treatment->name_it }}</td>
                        <td>{{ $treatment->name_es }}</td>
                        <td>{{ $treatment->name_pt }}</td>
                        <td>{{ $treatment->name_pl }}</td>
                        <td>{{ $treatment->name_ru }}</td>
                        <td>{{ $treatment->name_tr }}</td>
                        <td>{{ $treatment->name_ar }}</td>
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
            <h5 class="modal-title" id="exampleModalLabel">New Treatment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('treatment.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label for="nameEn">Treatment Name</label>
                            <input type="text" class="form-control" id="nameEn" name="nameEn" placeholder="Enter Treatment Name" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label for="nameDe">Treatment Name (DE)</label>
                            <input type="text" class="form-control" id="nameDe" name="nameDe" placeholder="Enter Treatment Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label for="nameFr">Treatment Name (FR)</label>
                            <input type="text" class="form-control" id="nameFr" name="nameFr" placeholder="Enter Treatment Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label for="nameIt">Treatment Name (IT)</label>
                            <input type="text" class="form-control" id="nameIt" name="nameIt" placeholder="Enter Treatment Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label for="nameEs">Treatment Name (ES)</label>
                            <input type="text" class="form-control" id="nameEs" name="nameEs" placeholder="Enter Treatment Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label for="nameAr">Treatment Name (AR)</label>
                            <input type="text" class="form-control" id="nameAr" name="nameAr" placeholder="Enter Treatment Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label for="desc">Note</label>
                            <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Note"></textarea>
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
