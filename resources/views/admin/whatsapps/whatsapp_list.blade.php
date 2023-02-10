@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 table-responsive">
         <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
               <li class="breadcrumb-item home-page"><a href="{{ route('home') }}">Arayüz</a></li>
               <li class="breadcrumb-item active" aria-current="page">Whatsapp Numaralar</li>
            </ol>
         </nav>
         <div class="card p-3 mt-3">
            <div class="card-title">
               <div class="row">
                  <div class="col-lg-6">
                     <h2>Whatsapp Numaralar</h2>
                  </div>
                  <div class="col-lg-6">
                     <button data-toggle="modal" data-target="#createWhatsappModal" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Whatsapp Ekle</button>
                  </div>
               </div>
            </div>
            <div class="dt-responsive table-responsive">
               <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col">İşlem</th>
                        <th scope="col">Whatsapp Numara</th>
                        <th scope="col">Ad Soyad</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Ülke</th>
                        <th scope="col">Not</th>
                     </tr>
                  </thead>
                  @foreach ($whatsapps as $whatsapp)
                  <tr>
                     <td>
                        <div class="dropdown">
                           <button class="btn btn-danger dropdown-toggle action-btn" type="button" data-toggle="dropdown">İşlem <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                              <li><a href="{{ route('whatsapp.edit', ['id' => $whatsapp->id]) }}" class="btn btn-info edit-btn inline-popups"><i class="fa fa-pencil-square-o"></i> Güncelle</a></li>
                              <li><a href="{{ route('whatsapp.destroy', ['id' => $whatsapp->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger edit-btn"><i class="fa fa-trash"></i> Sil</a></li>
                           </ul>
                        </div>
                     </td>
                     <td>{{ $whatsapp->phone }}</td>
                     <td>{{ $whatsapp->name_surname }}</td>
                     <td>{{ $whatsapp->email }}</td>
                     <td>{{ $whatsapp->country }}</td>
                     <td>{{ $whatsapp->note }}</td>
                  </tr>
                  @endforeach
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="createWhatsappModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yeni Whatsapp Numara</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('whatsapp.store') }}" method="POST">
               @csrf
               <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                       <label for="name_surname">Ad Soyad</label>
                       <input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Ad Soyad">
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                       <label for="phone">Whatsapp Numara</label>
                       <input type="text" class="form-control" id="phone" name="phone" placeholder="Whatsapp Numara" required>
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                       <label for="email">E-mail</label>
                       <input type="text" class="form-control" id="email" name="email" placeholder="E-mail">
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="country">Ülke</label>
                        <select name="country" class="form-control" id="country">
                            <option></option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                 </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="note">Not</label>
                        <input type="text" class="form-control" id="note" name="note" placeholder="Not">
                     </div>
                  </div>
               </div>
               <button type="submit" class="btn btn-success float-right">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
         </div>
      </div>
   </div>
</div>

@endsection
