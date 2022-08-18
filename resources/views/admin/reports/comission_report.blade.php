@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <button class="btn btn-danger" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
            <div class="card mt-3">
                <div class="card-body">
                
                </div>
            </div>
        </div>
    </div>

   <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right download-report-btn" onclick="paymentReportPdf();"><i class="fa fa-download"></i> İndir</button>
        </div>
        <div class="col-lg-12">
            <div id="root">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body" style="padding: 0; padding-top: 10px">
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $hotelComissions }}
                            </div>
                        </div>
                    </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection
