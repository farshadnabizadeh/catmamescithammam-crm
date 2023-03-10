<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Satışçı Güncelle</h2>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $sales_person->user->name }}</p>
                </div>
                <form action="{{ route('salesperson.update', ['id' => $sales_person->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name_surname">Adı Soyadı</label>
                                <input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Satışçı Adı Soyadı" value="{{ $sales_person->name_surname }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone_number">Telefon Numarası</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Satışçı Telefon Numarası" value="{{ $sales_person->phone_number }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email Adresi</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Satışçı Email Adresi" value="{{ $sales_person->email_address }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="note">Not</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Not" value="{{ $sales_person->note }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>