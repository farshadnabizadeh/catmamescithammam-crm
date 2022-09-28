@extends('layouts.app')

@section('content')

@include('layouts.navbar')


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-lg-12">

                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yeni Rol</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Rol Bilgileri</h3>
                        </div>
                        <form role="form" method="POST" action="{{ url('/roles/store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Rol Adı</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Örnek: Yönetici" autofocus required>
                                </div>

                                <div class="form-group">
                                    <label for="roleName">Permissions</label>
                                  <div class="row">
                                        @foreach($permissions as $value)
                                        <div class="col-lg-2">
                                        <label  class="form-group">{{ Form::checkbox('permission[]', $value->id, false, array('id' => 'name','class' => 'name'.$value->id)) }}
                                        {{ $value->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-block bg-gradient-success btn-lg"><i
                                        class="far fa-save"></i> KAYDET
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>
</div>




@endsection
