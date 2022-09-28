<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Medical Sub Department</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $medical_sub_department->user->name }}</p>
                </div>
                <form action="{{ route('medicalsubdepartment.update', ['id' => $medical_sub_department->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Medical Sub Department Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department Name" value="{{ $medical_sub_department->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="medicalDepartmentId">Medical Department</label>
                                <select class="form-control" name="departmentId" id="medicalDepartmentId">
                                    <option value="{{ $subDepartment->id }}" selected>{{ $subDepartment->parentDepartment->name }}</option>
                                    @foreach ($medical_departments as $medical_department)
                                    <option value="{{ $medical_department->id }}">{{ $medical_department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
