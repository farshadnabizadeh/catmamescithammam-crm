<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Hizmet Güncelle</h2>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $service->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/services/update/'.$service->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceName">Hizmet Adı</label>
                                <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="Hizmet Adı" value="{{ $service->service_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCurrency">Hizmet Para Birimi</label>
                                <select id="serviceCurrency" name="serviceCurrency" class="form-control" required>
                                    <option value="{{ $service->service_currency }}" @selected(true)>{{ $service->service_currency }}</option>
                                    <option value="EUR">EURO</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="TL">TL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceCost">Hizmet Ücreti</label>
                                <input type="text" class="form-control" id="serviceCost" name="serviceCost" placeholder="Hizmet Ücreti" value="{{ $service->service_cost }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>