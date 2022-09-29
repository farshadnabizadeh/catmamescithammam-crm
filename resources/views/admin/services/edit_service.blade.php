<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Hizmet Güncelle</h2>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $service->user->name }}</p>
                </div>
                <form action="{{ route('service.update', ['id' => $service->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Hizmet Adı</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Hizmet Adı" value="{{ $service->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="currency">Hizmet Para Birimi</label>
                                <select id="currency" name="currency" class="form-control" required>
                                    <option value="{{ $service->currency }}" @selected(true)>{{ $service->currency }}</option>
                                    <option value="EUR">EURO</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="TL">TL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cost">Hizmet Ücreti</label>
                                <input type="text" class="form-control" id="cost" name="cost" placeholder="Hizmet Ücreti" value="{{ $service->cost }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>