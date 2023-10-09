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
                                <button class="btn btn-success float-right download-report-btn mt-1" onclick="financeTableSalesAdmin()"><i class="fa fa-download"></i> İndir</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="financeTableSalesAdmin" style="zoom: 80%" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Rezervasyon Tarihi</th>
                                        <th>Gönderen Otel / Acenta</th>
                                        <th>PAX</th>
                                        @if($totalTL  <= 0)
                                        @else
                                        <th>Toplam TL</th>
                                        @endif
                                        @if($totalUSD <= 0)
                                        @else
                                        <th>Toplam USD</th>
                                        @endif
                                        @if($totalEURO <= 0)
                                        @else
                                        <th>Toplam EURO</th>
                                        @endif
                                        @if($totalGBP <= 0)
                                        @else
                                        <th>Toplam GBP</th>
                                        @endif
                                        <th>Hak Ediş Tutar</th>
                                        <th>Açıklama Ad Soyad</th>
                                        <th>Verilen Hizmet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->reservation_date }}</td>
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
                                        <td>{{ $reservation->total_customer }}</td>
                                        @if($totalTL > 0)
                                        <td>
                                            @php
                                            $totalTLPayment = 0; // Initialize the variable to store the sum
                                            @endphp

                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 5 || $value->payment_type_id == 9 || $value->payment_type_id == 10 || $value->payment_type_id == 18)
                                                    @php
                                                        $totalTLPayment += $value->payment_price; // Add the current payment_price to the total
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($totalTLPayment > 0)
                                                {{ $totalTLPayment }}
                                            @endif

                                        </td>
                                        @endif

                                        @if($totalUSD > 0)
                                        <td>
                                            @php
                                            $totalUSDPayment = 0; // Initialize the variable to store the sum
                                            @endphp

                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 7 || $value->payment_type_id == 12 || $value->payment_type_id == 17)
                                                    @php
                                                        $totalUSDPayment += $value->payment_price; // Add the current payment_price to the total
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($totalUSDPayment > 0)
                                                {{ $totalUSDPayment }}
                                            @endif
                                        </td>
                                        @endif

                                        @if($totalEURO > 0)
                                        <td>
                                            @php
                                            $totalEUROPayment = 0; // Initialize the variable to store the sum
                                            @endphp

                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 6 || $value->payment_type_id == 11 || $value->payment_type_id == 13 || $value->payment_type_id == 16)
                                                    @php
                                                        $totalEUROPayment += $value->payment_price; // Add the current payment_price to the total
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($totalEUROPayment > 0)
                                                {{ $totalEUROPayment }}
                                            @endif
                                        </td>
                                        @endif

                                        @if($totalGBP > 0)
                                        <td>
                                            @php
                                            $totalGBPPayment = 0; // Initialize the variable to store the sum
                                            @endphp

                                            @foreach($reservation->subPaymentTypes as $value)
                                                @if($value->payment_type_id == 8 || $value->payment_type_id == 19)
                                                    @php
                                                        $totalGBPPayment += $value->payment_price; // Add the current payment_price to the total
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($totalGBPPayment > 0)
                                                {{ $totalGBPPayment }}
                                            @endif
                                        </td>
                                        @endif

                                        <td>
                                            @foreach($reservation->subHotelComissions as $value)
                                                @if ( $value->comission_price != NULL)
                                                    {{ $value->comission_price }}
                                                @endif
                                            @endforeach
                                            @foreach($reservation->subGuideComissions as $values)
                                                @if ( $values->comission_price != NULL)
                                                    {{ $values->comission_price }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $reservation->customer->name_surname }}</td>
                                        <td>
                                            @foreach($reservation->subServices as $value)
                                               {{ $value->piece   }} {{ $value->name }} +
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th><b>{{ $totalPax }}</b></th>
                                        @if($totalTL <= 0)
                                        @else
                                        <th><b> {{ number_format($totalTL, 2) }}</b></th>
                                        @endif
                                        @if($totalUSD <= 0)
                                        @else
                                        <th><b> {{ number_format($totalUSD, 2) }}</b></th>
                                        @endif
                                        @if($totalEURO <= 0)
                                        @else
                                        <th><b> {{ number_format($totalEURO, 2) }}</b></th>
                                        @endif
                                        @if($totalGBP <= 0)
                                        @else
                                        <th><b>{{ number_format($totalGBP, 2) }}</b></th>
                                        @endif
                                        <th><b> {{ number_format($totalComission, 2) }}</b></th>
                                        <th></th>
                                        <th></th>
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
