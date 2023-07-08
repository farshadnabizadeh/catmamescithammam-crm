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
                        <div class="row">
                            <div class="col-lg-8">
                                <h3>{{ date('d-m-Y', strtotime($start)) }} & {{ date('d-m-Y', strtotime($end)) }} tarihleri arasındaki Ciro Raporu</h3>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-success float-right download-report-btn mt-1" onclick="financeTableExcel()"><i class="fa fa-download"></i> İndir</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="financeTable" style="zoom: 80%" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>PAX</th>
                                        <th>Açıklama Ad Soyad</th>
                                        <th>Gönderen Otel / Acenta</th>
                                        <th>Hak Ediş Tutar</th>
                                        <th>Verilen Hizmet</th>
                                        @if($cashTl <= 0)
                                        @else
                                        <th>CASH TL</th>
                                        @endif
                                        @if($cashUsd <= 0)
                                        @else
                                        <th>CASH USD</th>
                                        @endif
                                        @if($cashEur <= 0)
                                        @else
                                        <th>CASH EURO</th>
                                        @endif
                                        @if($cashPound <= 0)
                                        @else
                                        <th>CASH GBP</th>
                                        @endif
                                        @if($ziraatTl <= 0)
                                        @else
                                        <th>Ziraat Pos TL</th>
                                        @endif
                                        @if($ykbTl <= 0)
                                        @else
                                        <th>Ykb Pos TL</th>
                                        @endif
                                        @if($ziraatEuro <= 0)
                                        @else
                                        <th>Ziraat Pos EURO</th>
                                        @endif
                                        @if($ziraatDolar <= 0)
                                        @else
                                        <th>Ziraat Pos USD</th>
                                        @endif
                                        @if($viatorEuro <= 0)
                                        @else
                                        <th>Viator EURO</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)

                                    <tr>
                                        <td>{{ $reservation->total_customer }}</td>
                                        <td>{{ $reservation->customer->name_surname }}</td>
                                        @if ($reservation->source->id == 15 || $reservation->source->id == 14 || $reservation->source->id == 12)
                                            <td>GOOGLE</td>
                                        @elseif ($reservation->source->id == 3 || $reservation->source->id == 10)
                                            @foreach ($comissionNames as $comissionName)
                                                @if ($reservation->id ==  $comissionName->id)
                                                    @if($comissionName->hName)
                                                        <td>{{ $reservation->source->name }} / {{ $comissionName->hName }}</td>
                                                    @elseif ($comissionName->gName)
                                                        <td>{{ $reservation->source->name }} / {{ $comissionName->gName }}</td>
                                                    @endif
                                                @endif
                                            @endforeach

                                        @else
                                            <td>{{ $reservation->source->name }}</td>
                                        @endif
                                        <td>
                                            @foreach($reservation->subHotelComissions as $value)
                                                @if ( $value->comission_price != NULL)
                                                    {{ $value->comission_price }} {{ $value->comission_currency }}
                                                @endif
                                            @endforeach
                                            @foreach($reservation->subGuideComissions as $values)
                                                @if ( $values->comission_price != NULL)
                                                    {{ $values->comission_price }} {{ $values->comission_currency }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($reservation->subServices as $value)
                                                <span>{{ $value->piece   }} {{ $value->name }} +</span>
                                            @endforeach
                                        </td>
                                        @if($cashTl <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 5)
                                                <span>{{ $value->payment_price }} TL</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($cashUsd <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 7)
                                                <span>{{ $value->payment_price }} USD</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($cashEur <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 6)
                                                <span>{{ $value->payment_price }} EURO</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($cashPound <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 8)
                                                <span>{{ $value->payment_price }} GBP</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($ziraatTl <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 10)
                                                <span>{{ $value->payment_price }} TL</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($ykbTl <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 9)
                                                <span>{{ $value->payment_price }} TL</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($ziraatEuro <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 11)
                                                <span>{{ $value->payment_price }} EURO</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($ziraatDolar <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 12)
                                                <span>{{ $value->payment_price }} USD</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                        @if($viatorEuro <= 0)
                                        @else
                                        <td>
                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 13)
                                                <span>{{ $value->payment_price }} EURO</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Toplam Pax: <b>{{ $totalPax }} Kişi</b></th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $totalComission }} TL</th>
                                        <th></th>
                                        @if($cashTl <= 0)
                                        @else
                                        <th>Toplam CASH TL: <b>₺ {{ number_format($cashTl, 2) }}</b></th>
                                        @endif
                                        @if($cashUsd <= 0)
                                        @else
                                        <th>Toplam CASH USD: <b>$ {{ number_format($cashUsd, 2) }}</b></th>
                                        @endif
                                        @if($cashEur <= 0)
                                        @else
                                        <th>Toplam CASH EURO: <b>€ {{ number_format($cashEur, 2) }}</b></th>
                                        @endif
                                        @if($cashPound <= 0)
                                        @else
                                        <th>Toplam CASH GBP: <b>₺ {{ number_format($cashPound, 2) }}</b></th>
                                        @endif
                                        @if($ziraatTl <= 0)
                                        @else
                                        <th>Toplam Ziraat Pos TL: <b>₺ {{ number_format($ziraatTl, 2) }}</b></th>
                                        @endif
                                        @if($ykbTl <= 0)
                                        @else
                                        <th>Toplam Ykb Pos TL: <b>₺ {{ number_format($ykbTl, 2) }}</b></th>
                                        @endif
                                        @if($ziraatEuro <= 0)
                                        @else
                                        <th>Toplam Ziraat Pos EURO: <b>€ {{ number_format($ziraatEuro, 2) }}</b></th>
                                        @endif
                                        @if($ziraatDolar <= 0)
                                        @else
                                        <th>Toplam Ziraat Pos USD: <b>$ {{ number_format($ziraatDolar, 2) }}</b></th>
                                        @endif
                                        @if($viatorEuro <= 0)
                                        @else
                                        <th>Toplam Viator EURO: <b>€ {{ number_format($viatorEuro, 2) }}</b></th>
                                        @endif
                                    </tr>
                                </tfoot>
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
