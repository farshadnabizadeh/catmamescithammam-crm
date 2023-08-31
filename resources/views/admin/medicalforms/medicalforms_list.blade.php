@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-12 table-responsive">
            <button class="btn btn-danger" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Arayüz</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Medikal Formları</li>
                </ol>
            </nav>
            <div class="card mt-3">
                <div class="card-body">
                <form action="" method="GET">
                    <div class="row pb-3">
                        <div class="col-lg-6">
                            <label for="startDate">Başlangıç Tarihi</label>
                            <input type="text" class="form-control datepicker" id="startDate" name="startDate" placeholder="Başlangıç Tarihi" value="{{ $start }}" autocomplete="off" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="endDate">Bitiş Tarihi</label>
                            <input type="text" class="form-control datepicker" id="endDate" name="endDate" placeholder="Bitiş Tarihi" autocomplete="off" value="{{ $end }}" required>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-success mt-3 float-right" type="submit">Listele</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="card p-3 mt-3">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Medikal Formları</h2>
                            <hr>
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

@endsection
@section('footer')
{!! $html->scripts() !!}
<script>
    $(document).ready(function () {
        $('.image-popup').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
</script>
@endsection
