@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ url('home') }}">Arayüz</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rezervasyon Formları</li>
                </ol>
            </nav>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Rezervasyon Formları</h2>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    {!! $html->table() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">İletişim Durumu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="booking_form_id">
                            <label for="formStatus">Form Durumu</label>
                            <select name="formStatusId" id="formStatusId">
                                <option></option>
                                @foreach ($form_statuses as $form_status)
                                    <option value="{{ $form_status->id }}">{{ $form_status->status_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-success float-right" id="bookingBtn">Güncelle</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
{!! $html->scripts() !!}

@endsection
