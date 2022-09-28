<div class="modal fade" id="onlineUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="articles card">
                                <div class="card-header d-flex align-items-center">
                                <h2 class="h3">Online Users</h2>
                                </div>
                                <div class="card-body no-padding">
                                @foreach($users as $user)
                                    @if(Cache::has('user-is-online-' . $user->id))
                                    <div class="item d-flex align-items-center">
                                        <div class="image">
                                            <img src="{{ asset('assets/img/user-icon.png') }}" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="text">
                                            <a href="#">
                                                <h3 class="h5">{{ $user->name }}</h3>
                                            </a>
                                            <small>{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    @else
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="articles card">
                                <div class="card-header d-flex align-items-center">
                                    <h2 class="h3">Offline Users</h2>
                                </div>
                                <div class="card-body no-padding offline-users">
                                    @foreach($users as $user)
                                        @if(!Cache::has('user-is-online-' . $user->id))
                                        <div class="item d-flex align-items-center">
                                            <div class="image">
                                                <img src="{{ asset('assets/img/user-icon.png') }}" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="text">
                                                <a href="#">
                                                    <h3 class="h5">{{$user->name}}</h3>
                                                </a>
                                                <small>{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        @else
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
