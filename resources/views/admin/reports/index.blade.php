@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <button class="btn btn-danger" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
            <div class="card mt-3">
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row pb-3">
                            <div class="col-lg-6">
                                <label for="startDate">Başlangıç Tarihi</label>
                                <input type="text" class="form-control datepicker" id="startDate" name="startDate" placeholder="Başlangıç Tarihi" value="{{ $start }}" autocomplete="off" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="endDate">Bitiş Tarihi</label>
                                <input type="text" class="form-control datepicker" id="endDate" name="endDate" placeholder="Bitiş Tarihi" autocomplete="off" value="{{ $end }}" required>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-success mt-3 float-right" type="submit"><i class="fa fa-check"></i> Raporu Al</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
           <div id="root">
              <div class="card">
                    <div class="card-header">
                       <h3>{{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }} tarihleri arasındaki Ciro Raporu</h3>
                    </div>
                    <div class="card-body">
                        <table id="basic-btn" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>PAX</th>
                                    <th>Açıklama Ad Soyad</th>
                                    <th>Gönderen Otel / Acenta</th>
                                    <th>Hak Ediş Tutar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listCountByMonth as $reservation)
                                <tr>
                                    <td>{{ $reservation->total_customer }}</td>
                                    <td>{{ $reservation->name_surname }}</td>
                                    <td>{{ $reservation->source_name }}</td>
                                    <td>
                                        @foreach($reservation->agencies as $key => $value){{ $value->agency_name}}
                                        <br/>@endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
    </div>

</div>


@endsection
