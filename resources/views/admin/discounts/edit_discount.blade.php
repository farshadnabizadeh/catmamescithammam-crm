<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>İndirimi Güncelle</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $discount->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/discounts/update/'.$discount->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountName">İndirim Adı</label>
                                <input type="text" class="form-control" id="discountName" name="discountName" placeholder="İndirim Adı" value="{{ $discount->discount_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountCode">İndirim Kodu</label>
                                <input type="text" class="form-control" id="discountCode" name="discountCode" placeholder="İndirim Kodu" value="{{ $discount->discount_code }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountPercentage">Discount Percentage</label>
                                <input type="text" class="form-control" id="discountPercentage" name="discountPercentage" placeholder="Enter Discount Percentage" value="{{ $discount->discount_percentage }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discountNote">İndirim Notu</label>
                                <input type="text" class="form-control" id="discountNote" name="discountNote" placeholder="İndirim Notu" value="{{ $discount->note }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>