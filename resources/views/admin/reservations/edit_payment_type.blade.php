<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Rezervasyonu Güncelle</h2>
                </div>
                <form action="{{ url('/definitions/reservations/update/'.$reservation_payment_type->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="paymentType">Ödeme Türü</label>
                                <input type="number" class="form-control" id="paymentType" name="paymentType" placeholder="Ödeme Türü" value="{{ $reservation_payment_type->payment_type }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
