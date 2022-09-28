<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Lead Source</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $lead_source->user->name }}</p>
                </div>
                <form action="{{ route('leadsource.update', ['id' => $lead_source->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Lead Source Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Lead Source Name" value="{{ $lead_source->name }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>