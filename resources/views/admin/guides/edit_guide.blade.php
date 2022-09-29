<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Rehberi Güncelle</h2>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $guide->user->name }}</p>
                </div>
                <form action="{{ route('guide.update', ['id' => $guide->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Adı</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Adı" value="{{ $guide->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Telefon Numarası</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon Numarası" value="{{ $guide->phone }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="iban">Iban</label>
                                <input type="text" class="form-control" id="iban" name="iban" placeholder="Iban" value="{{ $guide->iban }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="note">Not</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Not" value="{{ $guide->note }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>