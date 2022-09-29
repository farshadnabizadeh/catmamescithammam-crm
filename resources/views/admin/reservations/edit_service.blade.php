<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Hizmeti Güncelle</h2>
                </div>
                <form action="{{ route('reservation.service.update', ['id' => $reservation_service->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="serviceId">Hizmet</label>
                                <select class="form-control" name="serviceId" id="serviceId">
                                    <option value="{{ $reservation_service->service->id }}" selected>{{ $reservation_service->service->name }}</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="piece">Adeti</label>
                                <input type="number" class="form-control" id="piece" name="piece" placeholder="Adet" value="{{ $reservation_service->piece }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
