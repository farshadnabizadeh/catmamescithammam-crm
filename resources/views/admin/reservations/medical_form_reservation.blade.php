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
                        <a class="nav-link" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'comissions']) }}"><i class="fa fa-percent"></i> Komisyon @if(!$hasComission) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                        <a class="nav-link active ms-0" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'medicalforms']) }}"><i class="fa fa-wpforms"></i> Medikal Form @if(!$hasMedicalForm) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-flex align-items-center mb-3">Medikal Formlar</h3>
                        <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addMform"><i class="fa fa-plus"></i> Medikal Form Ekle</button>
                            <table class="table dataTable" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Ad Soyad</th>
                                        <th>Telefon</th>
                                        <th>Ülke</th>
                                        <th>Email</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach($reservation->subMedicalForms as $subMedicalForm)
                                <tr>
                                    <td>{{ $subMedicalForm->name_surname }}</td>
                                    <td>{{ $subMedicalForm->phone }}</td>
                                    <td>{{ $subMedicalForm->country }}</td>
                                    <td>{{ $subMedicalForm->email }}</td>
                                    <td>
                                        <a href="{{ route('medicalform.edit', ['id' => $subMedicalForm->medical_form_id]) }}" class="btn btn-success"><i class="fa fa-eye"></i> Görüntüle</a>
                                        <a href="{{ route('reservation.medicalform.destroy', ['id' => $subMedicalForm->id]) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
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
    <div class="modal fade" id="addMform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Medikal Form Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="hidden" id="reservation_id" value="{{$reservation->id}}">
                            <label for="mFormID">Ad Soyad</label>
                            <select id="mFormID" class="form-control">
                                <option></option>
                                @foreach ($medical_forms as $medical_form)
                                <option value="{{ $medical_form->id }}">{{ $medical_form->name_surname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-primary" id="createMForm" style="margin-top: 2rem !important;">Ekle <i class="fa fa-plus" aria-hidden="true"></i></button>

                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <table class="table table-bordered mt-3" id="mFormTable">
                                    <tr>
                                        <th>Ad Soyad</th>
                                        <th>İşlem</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success float-right" id="saveMedicalForm">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
@endsection
