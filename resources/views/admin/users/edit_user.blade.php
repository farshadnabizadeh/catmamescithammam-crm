<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Kullanıcıyı Güncelle</h2>
                </div>
                <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Kullanıcı Adı</label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="Kullanıcı Adı" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userEmail">Email Adresi</label>
                                <input type="text" class="form-control" id="userEmail" name="userEmail" placeholder="Email Adresi" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userPassword">Şifre</label>
                                <input type="text" class="form-control" id="userPassword" name="userPassword" placeholder="Şifreyi Değiştir" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="roles">Rolü</label>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-5 float-right">Güncelle <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>