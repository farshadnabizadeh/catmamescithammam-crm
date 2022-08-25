<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Oteli Güncelle</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $hotel->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/hotels/update/'.$hotel->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelName">Otel Adı</label>
                                <input type="text" class="form-control" id="hotelName" name="hotelName" placeholder="Otel Adı" value="{{ $hotel->name }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelPhone">Otel Telefon Numarası</label>
                                <input type="text" class="form-control" id="hotelPhone" name="hotelPhone" placeholder="Otel Telefon Numarası" value="{{ $hotel->phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelPerson">Hotel Person</label>
                                <input type="text" class="form-control" id="hotelPerson" name="hotelPerson" placeholder="Enter Hotel Person" value="{{ $hotel->person }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="hotelPersonAccountNumber">Hotel Person Account Number</label>
                                <input type="text" class="form-control" id="hotelPersonAccountNumber" name="hotelPersonAccountNumber" placeholder="Enter Hotel Person Account Number" value="{{ $hotel->person_account_number }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>