<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Medical Department</h2>
                </div>
                <form action="{{ route('medicaldepartment.update', ['id' => $medical_department->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Medical Department Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department Name" value="{{ $medical_department->name }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
