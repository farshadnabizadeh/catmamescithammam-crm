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
                        <div class="dt-responsive table-responsive">
                            <table id="basic-btn" style="zoom: 80%" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>PAX</th>
                                        <th>Açıklama Ad Soyad</th>
                                        <th>Gönderen Otel / Acenta</th>
                                        <th>Hak Ediş Tutar</th>
                                        <th>Verilen Hizmet</th>
                                        <th>CASH TL</th>
                                        <th>CASH USD</th>
                                        <th>CASH EURO</th>
                                        <th>CASH GBP</th>
                                        <th>Ziraat Pos TL</th>
                                        <th>Ykb Pos TL</th>
                                        <th>Ziraat Pos EURO</th>
                                        <th>Ziraat Pos USD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)

                                    <tr>
                                        <td>{{ $reservation->total_customer }}</td>
                                        <td>{{ $reservation->customer->name_surname }}</td>
                                        <td>{{ $reservation->source->name }}</td>
                                        <td>
                                            @foreach($reservation->subHotelComissions as $value)
                                                @if ( $value->comission_price != NULL)
                                                    {{ $value->comission_price }} {{ $value->comission_currency }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subServices as $value)
                                                <span>{{ $value->piece   }} {{ $value->name }} +</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 5)
                                                <span>{{ $value->payment_price }} TL</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 7)
                                                <span>{{ $value->payment_price }} USD</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 6)
                                                <span>{{ $value->payment_price }} EURO</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 8)
                                                <span>{{ $value->payment_price }} GBP</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 10)
                                                <span>{{ $value->payment_price }} TL</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 9)
                                                <span>{{ $value->payment_price }} TL</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 11)
                                                <span>{{ $value->payment_price }} EURO</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 12)
                                                <span>{{ $value->payment_price }} USD</span>
                                                @endif
                                            @endforeach
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

</div>


@endsection
