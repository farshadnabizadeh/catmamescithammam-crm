<ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Ödeme Türleri @if(!$hasPaymentType) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="medication-tab" data-toggle="tab" href="#medication" role="tab" aria-controls="medication" aria-selected="false">Hizmetler @if(!$hasService) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="allergie-tab" data-toggle="tab" href="#allergie" role="tab" aria-controls="allergie" aria-selected="false">Terapistler @if(!$hasTherapist) <i class="fa fa-ban"></i> @else <i class="fa fa-check"></i> @endif</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
        <div class="card h-100">
            <div class="card-body">
                <h3 class="d-flex align-items-center mb-3">Ödeme Türleri</h3>
                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addPaymentTypeModal"><i class="fa fa-plus"></i> Ödeme Türü Ekle</button>
                    <table class="table dataTable" id="tableData">
                    <tr>
                        <th>Ödeme Türü</th>
                        <th>Ücret</th>
                        <th>İşlem</th>
                    </tr>
                    <tbody>
                        @foreach($reservation->subPaymentTypes as $subPaymentType)
                        <tr>
                            <td>{{ $subPaymentType->payment_type_name }}</td>
                            <td>{{ $subPaymentType->payment_price }} {{ $reservation->service_currency }}</td>
                            <td>
                                <a href="{{ url('/definitions/reservations/paymenttype/edit/'.$subPaymentType->id) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                <a href="{{ url('/definitions/reservations/paymenttype/destroy/'.$subPaymentType->id) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>Toplam:</td>
                            <td>{{ $totalPayment }} {{ $reservation->service_currency }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="medication" role="tabpanel" aria-labelledby="medication-tab">
        <div class="card h-100">
            <div class="card-body">
                <h3 class="d-flex align-items-center mb-3">Hizmetler</h3>
                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addServiceModal"><i class="fa fa-plus"></i> Hizmet Ekle</button>
                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                    <tr>
                        <th>Bakım</th>
                        <th>Adeti</th>
                        <th>İşlem</th>
                    </tr>
                    <tbody>
                        @foreach($reservation->subServices as $subService)
                        <tr>
                            <td>{{ $subService->service_name }}</td>
                            <td>{{ $subService->piece }}</td>
                            <td>
                                <a href="{{ url('/definitions/reservations/service/edit/'.$subService->id) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                <a href="{{ url('/definitions/reservations/service/destroy/'.$subService->id) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="allergie" role="tabpanel" aria-labelledby="allergie-tab">
        <div class="card h-100">
            <div class="card-body">
                <h3 class="d-flex align-items-center mb-3">Terapistler</h3>
                <button type="button" class="btn btn-primary float-right add-new-btn" data-toggle="modal" data-target="#addTherapistModal"><i class="fa fa-plus"></i> Terapist Ekle</button>
                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                    <tr>
                        <th>Terapist</th>
                        <th>Adeti</th>
                        <th>İşlem</th>
                    </tr>
                    <tbody>
                        @foreach($reservation->subTherapists as $subTherapist)
                        <tr>
                            <td>{{ $subTherapist->therapist_name }}</td>
                            <td>{{ $subTherapist->piece }}</td>
                            <td>
                                <a href="{{ url('/definitions/reservations/therapist/edit/'.$subTherapist->id) }}" class="btn btn-primary inline-popups remove-btn"><i class="fa fa-edit"></i> Güncelle</a>
                                <a href="{{ url('/definitions/reservations/therapist/destroy/'.$subTherapist->id) }}" class="btn btn-danger remove-btn" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-trash"></i> Sil</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>