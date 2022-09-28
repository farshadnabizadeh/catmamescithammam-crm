<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Sales Person</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $sales_person->user->name }}</p>
                </div>
                <form action="{{ route('salesperson.update', ['id' => $sales_person->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Sales Person Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Sales Person Name" value="{{ $sales_person->name_surname }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Sales Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Sales Person Phone Number" value="{{ $sales_person->phone_number }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Sales Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Sales Person Email" value="{{ $sales_person->email_address }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>