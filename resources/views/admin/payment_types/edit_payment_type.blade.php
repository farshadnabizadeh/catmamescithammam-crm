<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Ödeme Türünü Güncelle</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $payment_type->user->name }}</p>
                </div>
                <form action="{{ route('paymenttype.update', ['id' => $payment_type->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Ödeme Türü Adı</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ödeme Türü Adı" value="{{ $payment_type->type_name }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="note">Not</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Not" value="{{ $payment_type->note }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>