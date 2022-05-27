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
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mt-3 sub-table-title">Ödeme Türleri</h3>
                        <div class="dt-responsive table-responsive mb-5">
                            <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                <tr>
                                    <th>Ödeme Türü</th>
                                    <th>Ücret</th>
                                </tr>
                                <tbody>
                                    @foreach($reservation->subPaymentTypes as $subPaymentType)
                                    <tr>
                                        <td>{{ $subPaymentType->payment_type_name }}</td>
                                        <td>{{ $subPaymentType->payment_price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="mt-3 sub-table-title">Hizmetler</h3>
                        <div class="dt-responsive table-responsive mb-5">
                            <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                <tr>
                                    <th>Bakım</th>
                                    <th>Adeti</th>
                                </tr>
                                <tbody>
                                    @foreach($reservation->subServices as $subService)
                                    <tr>
                                        <td>{{ $subService->service_name }}</td>
                                        <td>{{ $subService->piece }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="sub-table-title">Terapistler</h3>
                        <div class="dt-responsive table-responsive mb-5">
                            <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                <tr>
                                    <th>Terapist</th>
                                    <th>Adeti</th>
                                </tr>
                                <tbody>
                                    @foreach($reservation->subTherapists as $subTherapist)
                                    <tr>
                                        <td>{{ $subTherapist->therapist_name }}</td>
                                        <td>{{ $subTherapist->piece }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        {{-- <button class="btn btn-danger float-right mt-5" data-toggle="modal" data-target="#addCustomer"><i class="fa fa-plus" aria-hidden="true"></i> Add New Customer</button> --}}
                    </div>
                </div>
                <form action="{{ url('/definitions/reservations/update/'.$reservation->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="arrivalDate">Rezervasyon Tarihi</label>
                                <input type="text" class="form-control datepicker" id="arrivalDate" name="arrivalDate" placeholder="Enter Reservation Date" value="{{ $reservation->reservation_date }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="reservationTime">Rezervasyon Saati</label>
                                <input type="text" class="form-control" id="arrivalTime" name="arrivalTime" placeholder="Enter Reservation Time" maxlength="5" onkeypress="timeFormat(this)" value="{{ $reservation->reservation_time }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="totalCustomer">Toplam Müşteri</label>
                                <input type="number" class="form-control" id="totalCustomer" name="totalCustomer" placeholder="Enter Total Customer" value="{{ $reservation->total_customer }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCost">Toplam Hizmet Bedeli</label>
                                <input type="number" class="form-control" id="serviceCost" name="serviceCost" placeholder="Enter Service Cost" value="{{ $reservation->service_cost }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceComission">Service Comission</label>
                                <input type="number" class="form-control" id="serviceComission" name="serviceComission" placeholder="Enter Service Comission" value="{{ $reservation->service_comission }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
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
                            <label for="customerId">Customer</label>
                            <select class="form-control" id="customerId" name="treatmentId" required>
                                <option></option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
               </div>
               <button type="button" class="btn btn-success float-right" id="saveCustomerReservation">Save <i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
         </div>
      </div>
   </div>
</div>

@endsection
