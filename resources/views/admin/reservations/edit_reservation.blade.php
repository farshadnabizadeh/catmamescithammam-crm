@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Rezervasyonu Güncelle</h2>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $reservation->user->name }}</p>
                    <hr>
                </div>
                <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Ödeme Türleri @if(!$hasPaymentType) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="medication-tab" data-toggle="tab" href="#medication" role="tab" aria-controls="medication" aria-selected="false">Hizmetler @if(!$hasService) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="allergie-tab" data-toggle="tab" href="#allergie" role="tab" aria-controls="allergie" aria-selected="false">Terapistler @if(!$hasTherapist) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="d-flex align-items-center mb-3">Ödeme Türleri</h3>
                                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addPaymentTypeModal"><i class="fa fa-plus"></i> Ödeme Türü Ekle</button>
                                    <table class="table dataTable" id="tableData">
                                    <tr>
                                        <th>Ödeme Türü</th>
                                        <th>Ücret</th>
                                        <th>İşlem</th>
                                    </tr>
                                    <tbody>
                                        @foreach($reservation->subPaymentTypes as $subPaymentType)
                                        <tr>
                                            <td>{{ $subPaymentType->payment_type_name }}</td>
                                            <td>{{ $subPaymentType->payment_price }} {{ $reservation->service_currency }}</td>
                                            <td>
                                                <a href="{{ url('/definitions/reservations/paymenttype/edit/'.$subPaymentType->id) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                                <a href="{{ url('/definitions/reservations/paymenttype/destroy/'.$subPaymentType->id) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>Toplam:</td>
                                            <td>{{ $totalPayment }} {{ $reservation->service_currency }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="medication" role="tabpanel" aria-labelledby="medication-tab">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="d-flex align-items-center mb-3">Hizmetler</h3>
                                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addServiceModal"><i class="fa fa-plus"></i> Hizmet Ekle</button>
                                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                    <tr>
                                        <th>Bakım</th>
                                        <th>Adeti</th>
                                        <th>İşlem</th>
                                    </tr>
                                    <tbody>
                                        @foreach($reservation->subServices as $subService)
                                        <tr>
                                            <td>{{ $subService->service_name }}</td>
                                            <td>{{ $subService->piece }}</td>
                                            <td>
                                                <a href="{{ url('/definitions/reservations/service/edit/'.$subService->id) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                                <a href="{{ url('/definitions/reservations/service/destroy/'.$subService->id) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="allergie" role="tabpanel" aria-labelledby="allergie-tab">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="d-flex align-items-center mb-3">Terapistler</h3>
                                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addTherapistModal"><i class="fa fa-plus"></i> Terapist Ekle</button>
                                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                    <tr>
                                        <th>Terapist</th>
                                        <th>Adeti</th>
                                        <th>İşlem</th>
                                    </tr>
                                    <tbody>
                                        @foreach($reservation->subTherapists as $subTherapist)
                                        <tr>
                                            <td>{{ $subTherapist->therapist_name }}</td>
                                            <td>{{ $subTherapist->piece }}</td>
                                            <td>
                                                <a href="{{ url('/definitions/reservations/therapist/edit/'.$subTherapist->id) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                                <a href="{{ url('/definitions/reservations/therapist/destroy/'.$subTherapist->id) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ url('/definitions/reservations/update/'.$reservation->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="arrivalDate">Rezervasyon Tarihi</label>
                                <input type="text" class="form-control datepicker" id="arrivalDate" name="arrivalDate" placeholder="Rezervasyon Tarihi" value="{{ $reservation->reservation_date }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="reservationTime">Rezervasyon Saati</label>
                                <input type="text" class="form-control" id="arrivalTime" name="arrivalTime" placeholder="Rezervasyon Saati" maxlength="5" onkeypress="timeFormat(this)" value="{{ $reservation->reservation_time }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="totalCustomer">Toplam Müşteri</label>
                                <input type="number" class="form-control" id="totalCustomer" name="totalCustomer" placeholder="Toplam Müşteri" value="{{ $reservation->total_customer }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCurrency">Para Birimi</label>
                                <select id="serviceCurrency" name="serviceCurrency" class="form-control" required>
                                    <option value="{{ $reservation->service_currency }}" @selected(true)>{{ $reservation->service_currency }}</option>
                                    <option value="EUR">EURO</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="TL">TL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceComission">Komisyon</label>
                                <input type="number" class="form-control" id="serviceComission" name="serviceComission" placeholder="Komisyon" value="{{ $reservation->service_comission }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right update-page-btn">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
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
                            <label for="paymentType">Ödeme Türü</label>
                            <select class="form-control" id="paymentType" name="paymentType" required>
                                <option></option>
                                @foreach ($payment_types as $payment_type)
                                <option value="{{ $payment_type->id }}">{{ $payment_type->payment_type_name }}</option>
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
                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="piece">Hizmet Adeti</label>
                            <input type="text" class="form-control" id="piece" placeholder="Hizmet Adeti">
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
                                <option value="{{ $therapist->id }}">{{ $therapist->therapist_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="piece">Kaç İş</label>
                            <input type="text" class="form-control" id="piece">
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
