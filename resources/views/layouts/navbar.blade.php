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
            <li class="nav-item" id="currenciesSection">
            </li>
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ asset('assets/img/user-img.png'); }}">
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
