<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
   <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
               <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                  <div class="sidenav-toggler-inner">
                     <i class="sidenav-toggler-line"></i>
                     <i class="sidenav-toggler-line"></i>
                     <i class="sidenav-toggler-line"></i>
                  </div>
               </div>
            </li>
            <li class="nav-item" id="currenciesSection"></li>
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
                     <h6 class="text-overflow m-0">Hoşgeldiniz, {{auth()->user()->name}}</h6>
                     <hr>
                  </div>
                  <a href="#!" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Profilim</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="{{ url('/logout') }}" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Çıkış Yap</span>
                  </a>
               </div>
            </li>
         </ul>
      </div>
   </div>
</nav>