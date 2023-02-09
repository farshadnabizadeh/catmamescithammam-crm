<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Whatsapp Numara Güncelle</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $whatsapp->user->name }}</p>
                </div>
                <form action="{{ route('whatsapp.update', ['id' => $whatsapp->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="name_surname">Ad soyad</label>
                                <input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Ad Soyad" value="{{ $whatsapp->name_surname }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="phone">Whatsapp Numara</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Whatsapp Numara" value="{{ $whatsapp->phone }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ $whatsapp->email }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                               <label for="country">Ülke</label>
                               <select name="country" class="form-control" id="country">
                                       <option value="{{ $whatsapp->country }}">{{ $whatsapp->country }}</option>
                                       @foreach ($countries as $country)
                                       <option value="{{ $country->name }}">{{ $country->name }}</option>
                                       @endforeach
                               </select>
                           </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="note">Not</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Not" value="{{ $whatsapp->note }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
