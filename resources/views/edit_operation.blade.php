<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Operation Date</h2>
                </div>
                <form action="{{ url('/definitions/treatmentplans/updateOperationDate/'.$treatment_plans->id) }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="arrivalDate">Arrival Date</label>
                                <input type="date" class="form-control" id="arrivalDate" name="arrival_date" placeholder="Enter Arrival Date" value="{{ $treatment_plans->arrival_date }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="operationDate">Operation Date</label>
                                <input type="date" class="form-control" id="operationDate" name="operation_date" placeholder="Enter Operation Date" value="{{ $treatment_plans->operation_date }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="departureDate">Departure Date</label>
                                <input type="date" class="form-control" id="departureDate" name="departure_date" placeholder="Enter Departure Date" value="{{ $treatment_plans->departure_date }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>