<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h3>Edit Payment Type</h3>
                    <p class="float-right last-user">İşlem Yapan Son Kullanıcı: {{ $payment_type->user->name }}</p>
                </div>
                <form action="{{ url('/definitions/payment_types/update/'.$payment_type->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="paymentTypeName">Payment Type Name</label>
                                <input type="text" class="form-control" id="paymentTypeName" name="paymentTypeName" placeholder="Enter Payment Type Name" value="{{ $payment_type->payment_type_name }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note" value="{{ $payment_type->note }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>