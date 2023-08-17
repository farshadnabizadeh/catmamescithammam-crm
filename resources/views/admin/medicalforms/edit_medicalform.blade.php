@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>İletişim Form Güncelle</h3>
                </div>
                <form action="{{ route('contactform.update', ['id' => $contact_form->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameSurname">Adı Soyadı</label>
                                <input type="text" class="form-control" name="nameSurname" id="nameSurname" value="{{$contact_form->name_surname}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Telefon Numarası</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$contact_form->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{$contact_form->email}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="country">Ülkesı</label>
                                <select name="country" class="form-control" id="country">
                                    <option value="{{ $contact_form->country }}">{{ $contact_form->country }}</option>
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
