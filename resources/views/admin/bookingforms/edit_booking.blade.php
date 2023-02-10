@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Rezervasyon Güncelle</h3>
                </div>
                <form action="{{ route('bookingform.update', ['id' => $booking_form->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="reservation_date">Rezervasyon Tarihi</label>
                                    <input type="date" name="reservation_date" class="form-control" id="startDate" value="{{ $booking_form->reservation_date }}">
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="reservation_time">Rezervasyon Saatı</label>
                                    <select name="reservation_time" class="form-control" id="reservation-time">
                                        <option value="{{$booking_form->reservation_time}}" selected>{{$booking_form->reservation_time}}</option>
                                        <option value="08:30 - 09:00" >08:30 - 09:00</option>
                                        <option value="09:00 - 09:30">09:00 - 09:30</option>
                                        <option value="09:30 - 10:00">09:30 - 10:00</option>
                                        <option value="10:00 - 10:30">10:00 - 10:30</option>
                                        <option value="10:30 - 11:00">10:30 - 11:00</option>
                                        <option value="11:00 - 11:30">11:00 - 11:30</option>
                                        <option value="11:30 - 12:00">11:30 - 12:00</option>
                                        <option value="12:00 - 12:30">12:00 - 12:30</option>
                                        <option value="12:30 - 13:00">12:30 - 13:00</option>
                                        <option value="13:00 - 13:30">13:00 - 13:30</option>
                                        <option value="13:30 - 14:00">13:30 - 14:00</option>
                                        <option value="14:00 - 14:30">14:00 - 14:30</option>
                                        <option value="14:30 - 15:00">14:30 - 15:00</option>
                                        <option value="15:00 - 15:30">15:00 - 15:30</option>
                                        <option value="15:30 - 16:00">15:30 - 16:00</option>
                                        <option value="16:00 - 17:00">16:00 - 17:00</option>
                                        <option value="17:00 - 17:30">17:00 - 17:30</option>
                                        <option value="17:30 - 18:00">17:30 - 18:00</option>
                                        <option value="18:00 - 18:30">18:00 - 18:30</option>
                                        <option value="18:30 - 19:00">18:30 - 19:00</option>
                                        <option value="19:00 - 19:30">19:00 - 19:30</option>
                                        <option value="19:30 - 20:00">19:30 - 20:00</option>
                                        <option value="20:00 - 20:30">20:00 - 20:30</option>
                                        <option value="20:30 - 21:00">20:30 - 21:00</option>
                                        <option value="21:00 - 21:30">21:00 - 21:30</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name_surname">Adı Soyadı</label>
                                    <input type="text" name="name_surname" class="form-control" value="{{ $booking_form->name_surname}}">
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Telefon Numarası</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $booking_form->phone }}">
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Erkek Kişi Sayısı</label>
                                    <input type="number" name="male_pax" class="form-control" value="{{ $booking_form->male_pax }}">
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Kadın Kişi Sayısı</label>
                                    <input type="number" name="female_pax" class="form-control" value="{{ $booking_form->female_pax }}">
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hammam_package">Hamam Paketi</label>
                                    <select name="hammam_package[]" id="hammam_package" class="form-control" id="hammam_package" multiple>
                                        <option value="{{$booking_form->hammam_package}}" selected>{{$booking_form->hammam_package}}</option>
                                        <option value="Pasha Hammam"> Pasha Hammam</option>
                                        <option value="Shahrazad Hammam"> Shahrazad Hammam</option>
                                        <option value="Sultan Hammam"> Sultan Hammam</option>
                                        <option value="VIP Hammam"> VIP Hammam</option>
                                        <option value="Luxury Hammam"> Luxury Hammam</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="massage_package">Masaj Paketi</label>
                                    <select name="massage_package[]" id="massage_package" class="form-control" multiple>
                                        <option value="{{$booking_form->massage_package}}" selected>{{$booking_form->massage_package}}</option>
                                        <option value="Anti-Stress Massage"> Anti-Stress Massage </option>
                                        <option value="Hot Stone Massage"> Hot Stone Massage </option>
                                        <option value="Catma Signature Massage"> Catma Signature Massage </option>
                                        <option value="Blend Thai Massage"> Blend Thai Massage </option>
                                        <option value="Aromatherapy Massage"> Aromatherapy Massage </option>
                                        <option value="Thai Massage"> Thai Massage </option>
                                        <option value="Bali Massage"> Bali Massage </option>
                                        <option value="Reflexology"> Reflexology </option>
                                        <option value="Deep Tissue Massage"> Deep Tissue Massage </option>
                                        <option value="Regional Trilogy Massage"> Regional Trilogy Massage </option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="country">Ülkesı</label>
                                <select name="country" class="form-control" id="country">
                                    <option value="{{ $booking_form->country }}">{{ $booking_form->country }}</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
