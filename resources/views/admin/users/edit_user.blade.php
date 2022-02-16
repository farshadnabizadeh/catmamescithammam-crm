@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Page</button>
            <div class="card p-5 mt-3">
                <div class="card-title">
                    <h2>Edit User</h2>
                </div>
                <form action="{{ url('/definitions/users/update/'.$user->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Username</label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter Username" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userEmail">Email</label>
                                <input type="text" class="form-control" id="userEmail" name="userEmail" placeholder="Email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="departmentId">Password</label>
                                <input type="text" class="form-control" id="treatmentName" name="treatmentName" placeholder="Change Password" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="agencyId">Kullanıcının Rolleri</label>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
