<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>İndirimi Güncelle</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $discount->user->name }}</p>
                </div>
                <form action="{{ route('discount.update', ['id' => $discount->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">İndirim Adı</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="İndirim Adı" value="{{ $discount->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="code">İndirim Kodu</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="İndirim Kodu" value="{{ $discount->code }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="percentage">İndirim Yüzdesi</label>
                                <input type="text" class="form-control" id="percentage" name="percentage" placeholder="İndirim Yüzdesi" value="{{ $discount->percentage }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="note">İndirim Notu</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="İndirim Notu" value="{{ $discount->note }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>