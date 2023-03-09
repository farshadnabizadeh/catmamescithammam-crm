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
                        <a class="nav-link active ms-0" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'payments']) }}"><i class="fa fa-money"></i> Ödeme Bilgileri @if(!$hasPaymentType) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                        <a class="nav-link" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'comissions']) }}"><i class="fa fa-percent"></i> Komisyon @if(!$hasComission) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-flex align-items-center mb-3">Ödemeler</h3>
                        <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addPaymentTypeModal"><i class="fa fa-plus"></i> Ödeme Türü Ekle</button>
                            <table class="table dataTable" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Ödeme Türü</th>
                                        <th>Ücret</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach($reservation->subPaymentTypes as $subPaymentType)
                                <tr>
                                    <td>{{ $subPaymentType->type_name }}</td>
                                    <td>{{ $subPaymentType->payment_price }}</td>
                                    <td>
                                        <a href="{{ route('reservation.paymenttype.edit', ['id' => $subPaymentType->id]) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                        <a href="{{ route('reservation.paymenttype.destroy', ['id' => $subPaymentType->id]) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <td>Toplam TL: {{ number_format($totalTL, 2) }}</td>
                            <td>Toplam EURO: {{ number_format($totalEuro, 2) }}</td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPaymentTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Ödeme Türü Ekle</h5>
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
                                    <label for="paymentTypeId">Ödeme Türü</label>
                                    <select class="form-control" id="paymentTypeId" name="paymentTypeId" required>
                                        <option></option>
                                        @foreach ($payment_types as $payment_type)
                                        <option value="{{ $payment_type->id }}">{{ $payment_type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="paymentPrice">Ücret</label>
                                    <input type="text" class="form-control" placeholder="Ücret" id="paymentPrice">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success float-right" id="addPaymentTypetoReservationSave">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addComissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Ödeme Türü Ekle</h5>
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
                                    <label for="paymentType">Ödeme Türü</label>
                                    <select class="form-control" id="paymentType" name="paymentType" required>
                                        <option></option>
                                        @foreach ($payment_types as $payment_type)
                                        <option value="{{ $payment_type->id }}">{{ $payment_type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="paymentPrice">Ücret</label>
                                    <input type="text" class="form-control" placeholder="Ücret" id="paymentPrice">
                                </div>
                            </div>
                        </div>
                    <button type="button" class="btn btn-success float-right" id="addPaymentTypetoReservationSave">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

@endsection
