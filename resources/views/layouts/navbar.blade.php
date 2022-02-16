<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>
                    <input class="form-control" placeholder="Search" type="text" name="searchForm" id="searchname">
                </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </form>
        <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item">
                <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <div class="px-3 py-3">
                    <h6 class="text-sm text-muted m-0"><strong class="text-primary">1</strong> notification</h6>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <img alt="Image placeholder" src="" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                            <h4 class="mb-0 text-sm"></h4>
                            </div>
                            <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                            </div>
                        </div>
                        <p class="text-sm mb-0">desc</p>
                        </div>
                    </div>
                    </a>
                </div>
                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <div class="px-3 py-3">
                    <h6 class="text-sm text-muted m-0"><strong class="text-primary">1</strong> notification</h6>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <img alt="Image placeholder" src="" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                            <h4 class="mb-0 text-sm"></h4>
                            </div>
                            <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                            </div>
                        </div>
                        <p class="text-sm mb-0">desc</p>
                        </div>
                    </div>
                    </a>
                </div>
                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ asset('http://simpleicon.com/wp-content/uploads/user1-256x256.png'); }}">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm username">{{auth()->user()->name}}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome, {{auth()->user()->name}}</h6>
                <hr>
              </div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ url('/logout') }}" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
