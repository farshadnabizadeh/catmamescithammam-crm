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
                        <button class="btn btn-success mt-3 float-right" type="submit">Raporu Al</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-lg-12">
         <div class="card p-3">
            <div class="card-title">
               <h2>Ciro Raporu | {{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }}</h2>
               <hr>
            </div>
            <div class="card-body">
               <p>CASH TL: {{ $cashTl }}</p>
               <p>CASH EURO: {{ $cashEur }}</p>
               <p>CASH DOLAR: {{ $cashUsd }}</p>
               <p>CASH POUND: {{ $cashPound }}</p>
               <hr>
               <p>YKB KK TL: {{ $ykbTl }}</p>
               <p>ZİRAAT KK TL: {{ $ziraatTl }}</p>
               <p>ZİRAAT KK EURO: {{ $ziraatEuro }}</p>
               <p>ZİRAAT KK DOLAR: {{ $ziraatDolar }}</p>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
