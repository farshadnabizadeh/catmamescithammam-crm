<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Oteli Güncelle</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $hotel->user->name }}</p>
                </div>
                <form action="{{ route('hotel.update', ['id' => $hotel->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Otel Adı</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Otel Adı" value="{{ $hotel->name }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="phone">Otel Telefon Numarası</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Otel Telefon Numarası" value="{{ $hotel->phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="person">Hotel Person</label>
                                <input type="text" class="form-control" id="person" name="person" placeholder="Otel İlgili Kişisi" value="{{ $hotel->person }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="personAccountNumber">Hotel Person Account Number</label>
                                <input type="text" class="form-control" id="personAccountNumber" name="personAccountNumber" placeholder="Otel Kişisi Hesap Numarasını Girin" value="{{ $hotel->person_account_number }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>