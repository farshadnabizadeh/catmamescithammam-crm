@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Önceki Sayfa</button>
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Rolü Güncelle</h2>
                </div>
                <form action="{{ url('/roles/update/'.$role->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Rol Adı</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" autofocus required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2>Yetkiler</h2>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        @foreach($permissions as $value)
                            <div class="col-4 mt-2">
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('id' => 'name','class' => 'name'.$value->id)) }} {{ $value->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
