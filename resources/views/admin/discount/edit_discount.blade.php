
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Discount</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $discount->user->name }}</p>
                </div>
                <form action="{{ route('discount.update', ['id' => $discount->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Discount Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Discount Name" value="{{ $discount->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{ $discount->amount }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="percentage">Percentage</label>
                                <input type="text" class="form-control" id="percentage" name="percentage" placeholder="Enter Percentage" value="{{ $discount->percentage }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note" value="{{ $discount->note }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>