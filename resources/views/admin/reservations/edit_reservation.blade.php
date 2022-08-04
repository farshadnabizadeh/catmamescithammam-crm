@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <nav class="nav nav-borders">
                        <a class="nav-link active ms-0" href="{{ url('') }}"><i class="fa fa-user"></i> Rezervasyon Bilgileri</a>
                        <a class="nav-link" href="{{ url('') }}"><i class="fa fa-money"></i> Ödeme Bilgileri</a>
                        <a class="nav-link disabled" href="{{ url('') }}" aria-disabled="true">Doctor's Recommendations</a>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
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
