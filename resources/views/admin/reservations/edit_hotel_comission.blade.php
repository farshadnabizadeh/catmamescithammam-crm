<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Otel Komisyonunu Güncelle</h2>
                </div>
                <form action="{{ url('/definitions/reservations/paymenttype/update/'.$hotel_comission->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="paymentTypeId">Ödeme Türü</label>
                                <select class="form-control" name="paymentTypeId" id="paymentTypeId">
                                    <option value="{{ $hotel_comission->hotel->id }}" selected>{{ $hotel_comission->hotel->name }}</option>
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="comissionPrice">Ücret</label>
                                <input type="number" class="form-control" id="comissionPrice" name="comissionPrice" placeholder="Ücret" value="{{ $hotel_comission->payment_price }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
