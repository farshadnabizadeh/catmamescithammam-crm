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
                        <a class="nav-link active ms-0" href="{{ route('reservation.edit', ['id' => $reservation->id]) }}"><i class="fa fa-user"></i> Rezervasyon Bilgileri</a>
                        <a class="nav-link" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'payments']) }}"><i class="fa fa-money"></i> Ödeme Bilgileri @if(!$hasPaymentType) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                        <a class="nav-link" href="{{ route('reservation.edit', ['id' => $reservation->id, 'page' => 'comissions']) }}"><i class="fa fa-percent"></i> Komisyon @if(!$hasComission) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <form action="{{ route('reservation.update', ['id' => $reservation->id]) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="arrivalDate">Rezervasyon Tarihi</label>
                                                        <input type="text" class="form-control datepicker" id="editArrivalDate" name="reservationDate" placeholder="Rezervasyon Tarihi" value="{{ $reservation->reservation_date }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="reservationTime">Rezervasyon Saati</label>
                                                        <input type="text" class="form-control" id="arrivalTime" name="reservationTime" placeholder="Rezervasyon Saati" maxlength="5" onkeypress="timeFormat(this)" value="{{ $reservation->reservation_time }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pickupTime">Alınış Saati</label>
                                                        <input type="text" class="form-control" id="pickupTime" name="pickupTime" placeholder="Alınış Saati" maxlength="5" onkeypress="timeFormat(this)" autocomplete="off" value="{{ $reservation->pickup_time }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="roomNumber">Oda Numarası</label>
                                                        <input type="number" class="form-control" id="roomNumber" name="roomNumber" placeholder="Oda Numarası" value="{{ $reservation->room_number }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="totalCustomer">Toplam Müşteri</label>
                                                        <input type="number" class="form-control" id="totalCustomer" name="totalCustomer" placeholder="Toplam Müşteri" value="{{ $reservation->total_customer }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="sobId">Rezervasyon Kaynağı</label>
                                                        <select id="sobId" name="sourceId" class="form-control">
                                                            <option value="{{ $reservation->source_id }}" selected>{{ $reservation->source->name }}</option>
                                                            @foreach ($sources as $source)
                                                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="note">Rezervasyon Notu</label>
                                                        <textarea class="form-control" name="note" id="note" placeholder="Rezervasyon Notu">{{ $reservation->reservation_note }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success mt-5 float-right update-page-btn">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mt-3 h-100">
                                    <div class="card-body">
                                        <h3 class="d-flex align-items-center mb-3">Hizmetler</h3>
                                        <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addServiceModal"><i class="fa fa-plus"></i> Hizmet Ekle</button>
                                        <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                            <thead>
                                                <tr>
                                                    <th>Bakım</th>
                                                    <th>Adeti</th>
                                                    <th>Islem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reservation->subServices as $subService)
                                                <tr>
                                                    <td>{{ $subService->name }}</td>
                                                    <td>{{ $subService->piece }}</td>
                                                    <td>
                                                        <a href="{{ route('reservation.service.edit', ['id' => $subService->id]) }}" class="btn btn-warning inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                                        <a href="{{ route('reservation.service.destroy', ['id' => $subService->id]) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mt-3 h-100">
                                    <div class="card-body">
                                        <h3 class="d-flex align-items-center mb-3">Terapistler</h3>
                                        @can('create reservation')
                                        <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addTherapistModal"><i class="fa fa-plus"></i> Terapist Ekle</button>
                                        @endcan
                                        <table class="table table-striped table-bordered nowrap dataTable" id="tableTherapist">
                                            <thead>
                                                <tr>
                                                    <th>Terapist</th>
                                                    <th>Adeti</th>
                                                    <th>Islem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reservation->subTherapists as $subTherapist)
                                                <tr>
                                                    <td>{{ $subTherapist->name }}</td>
                                                    <td>{{ $subTherapist->piece }}</td>
                                                    <td>
                                                        <a href="{{ route('reservation.therapist.edit', ['id' => $subTherapist->id]) }}" class="btn btn-warning inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                                        <a href="{{ route('reservation.therapist.destroy', ['id' => $subTherapist->id]) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
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
    </div>
</div>

<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yeni Hizmet Ekle</h5>
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
                            <label for="serviceId">Hizmet</label>
                            <select class="form-control" id="serviceId" name="serviceId" required>
                                <option></option>
                                @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="piece">Hizmet Adeti</label>
                            <input type="number" class="form-control" id="piece" placeholder="Hizmet Adeti">
                        </div>
                    </div>
               </div>
               <button type="button" class="btn btn-success float-right" id="addServicetoReservationSave">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="addTherapistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yeni Terapist Ekle</h5>
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
                            <label for="therapistId">Terapist</label>
                            <select class="form-control" id="therapistId" name="therapistId" required>
                                <option></option>
                                @foreach ($therapists as $therapist)
                                <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="piece">Kaç İş</label>
                            <input type="number" class="form-control" id="piece">
                        </div>
                    </div>
               </div>
               <button type="button" class="btn btn-success float-right" id="addTherapisttoReservationSave">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
         </div>
      </div>
   </div>
</div>

@endsection
