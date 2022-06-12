<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Hizmeti Güncelle</h2>
                </div>
                <form action="{{ url('/definitions/reservations/paymenttype/update/'.$reservation_payment_type->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="paymentTypeId">Ödeme Türü</label>
                                <select class="form-control" name="paymentTypeId" id="paymentTypeId">
                                    <option value="{{ $reservation_payment_type->paymentType->id }}" selected>{{ $reservation_payment_type->paymentType->payment_type_name }}</option>
                                    @foreach ($payment_types as $payment_type)
                                        <option value="{{ $payment_type->id }}">{{ $payment_type->payment_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="paymentPrice">Ücret</label>
                                <input type="number" class="form-control" id="paymentPrice" name="paymentPrice" placeholder="Ücret" value="{{ $reservation_payment_type->payment_price }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
