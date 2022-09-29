<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Terapist Güncelle</h2>
                </div>
                <form action="{{ route('reservation.therapist.update', ['id' => $reservation_therapist->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="therapistId">Terapist</label>
                                <select class="form-control" name="therapistId" id="therapistId">
                                    <option value="{{ $reservation_therapist->therapist->id }}" selected>{{ $reservation_therapist->therapist->name }}</option>
                                    @foreach ($therapists as $therapist)
                                        <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="piece">Adeti</label>
                                <input type="number" class="form-control" id="piece" name="piece" placeholder="Adet" value="{{ $reservation_therapist->piece }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
