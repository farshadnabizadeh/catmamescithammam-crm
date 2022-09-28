@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Durumu Güncelle</h3>
                </div>
                <form action="{{ route('contactform.change', ['id' => $contact_form->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="formStatusId">Form Durumu</label>
                                <select name="formStatusId" id="formStatusId">
                                    <option value="{{ $contact_form->form_status_id }}" selected>{{ $contact_form->status->name }}</option>
                                    @foreach ($form_statuses as $form_status)
                                    <option value="{{ $form_status->id }}">{{ $form_status->name }}</option>
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