@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <nav class="nav nav-borders">
                        <a class="nav-link" href="{{ route('reservation.edit', ['id' => $reservation->id]) }}"><i class="fa fa-user"></i> Rezervasyon Bilgileri</a>
                        <a class="nav-link" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'payments']) }}"><i class="fa fa-money"></i> Ödeme Bilgileri @if(!$hasPaymentType) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                        <a class="nav-link active ms-0" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'comissions']) }}"><i class="fa fa-percent"></i> Komisyon @if(!$hasComission) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="d-flex align-items-center mb-3">Otel Komisyonu</h3>
                                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addHotelComissionModal"><i class="fa fa-plus"></i> Otel Komisyonu Ekle</button>

                                    <table class="table dataTable" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Otel</th>
                                                <th>Ücret</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($reservation->subHotelComissions as $subHotelComission)
                                        <tr>
                                            <td>{{ $subHotelComission->name }}</td>
                                            <td>{{ number_format($subHotelComission->comission_price, 2) . ' ' . $subHotelComission->comission_currency }}</td>
                                            <td>
                                                <a href="{{ route('reservation.hotelcomission.edit', ['id' => $subHotelComission->id]) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                                <a href="{{ route('reservation.hotelcomission.destroy', ['id' => $subHotelComission->id]) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <h3 class="d-flex align-items-center mb-3">Rehber Komisyonu</h3>
                                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addGuideComissionModal"><i class="fa fa-plus"></i> Rehber Komisyonu Ekle</button>
                                    <table class="table dataTable" id="tableData">
                                        <thead>
                                            <tr>
                                                <th>Rehber</th>
                                                <th>Ücret</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($reservation->subGuideComissions as $subGuideComission)
                                        <tr>
                                            <td>{{ $subGuideComission->name }}</td>
                                            <td>{{ number_format($subGuideComission->comission_price, 2) . ' ' . $subGuideComission->comission_currency }}</td>
                                            <td>
                                                <a href="{{ route('reservation.guidecomission.edit', ['id' => $subGuideComission->id]) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                                <a href="{{ route('reservation.guidecomission.destroy', ['id' => $subGuideComission->id]) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
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

    <div class="modal fade" id="addHotelComissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Otel Komisyonu Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <input type="hidden" id="reservation_id" value="{{ $reservation->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="hotelId">Otel</label>
                                    <select class="form-control" id="hotelId" name="hotelId" required>
                                        <option></option>
                                        @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="paymentPrice">Verilen Komisyon Ücreti</label>
                                    <input type="text" class="form-control" placeholder="Ücret" id="paymentPrice">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success float-right" id="addHotelComissiontoReservationSave">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addGuideComissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Rehber Komisyonu Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        <input type="hidden" id="reservation_id" value="{{ $reservation->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="guideId">Rehber</label>
                                    <select class="form-control" id="guideId" name="guideId" required>
                                        <option></option>
                                        @foreach ($guides as $guide)
                                        <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="paymentPrice">Verilen Komisyon Ücreti</label>
                                    <input type="text" class="form-control" placeholder="Ücret" id="paymentPrice">
                                </div>
                            </div>
                        </div>
                    <button type="button" class="btn btn-success float-right" id="addGuideComissiontoReservationSave">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

@endsection
