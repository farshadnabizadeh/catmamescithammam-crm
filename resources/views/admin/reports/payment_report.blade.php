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
         <div id="root">
            <div class="card p-3">
                <div class="card-header">
                   <button class="btn btn-primary float-right download-report-btn" onclick="paymentReportPdf();"><i class="fa fa-download"></i> İndir</button>
                    <h2>Ciro Raporu | {{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p>CASH TL: <b>₺ {{ number_format($cashTl, 2) }}</b></p>
                            <p>CASH EURO: <b>€ {{ number_format($cashEur, 2) }}</b></p>
                            <p>CASH DOLAR: <b>$ {{ number_format($cashUsd, 2) }}</b></p>
                            <p>CASH POUND: <b>£ {{ number_format($cashPound, 2) }}</b></p>
                        </div>
                        <div class="col-lg-6">
                            <p>YKB KK TL: <b>₺ {{ number_format($ykbTl, 2) }}</b></p>
                            <p>ZİRAAT KK TL: <b>₺ {{ number_format($ziraatTl, 2) }}</b></p>
                            <p>ZİRAAT KK EURO: <b>€ {{ number_format($ziraatEuro, 2) }}</b></p>
                            <p>ZİRAAT KK DOLAR: <b>$ {{ number_format($ziraatDolar, 2) }}</b></p>
                            <p>VIATOR EURO: <b>€ {{ number_format($viatorEuro, 2) }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
