<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="{{ asset('assets/img/catmamescitlogosiyah.png') }}" class="navbar-brand-img">
            </a>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home*') ? 'active' : '' }}" href="{{ url('/home'); }}">
                            <i class="fa fa-pie-chart text-primary"></i>
                            <span class="nav-link-text" id="testData">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/customers*') ? 'active' : '' }}" href="{{ url('/definitions/customers'); }}">
                            <i class="fa fa-users text-primary"></i>
                            <span class="nav-link-text">Customers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/contactforms*') ? 'active' : '' }}" href="{{ url('/definitions/contactforms'); }}">
                            <i class="fa fa-align-justify text-primary"></i>
                            <span class="nav-link-text">Contact Forms</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/discounts*') ? 'active' : '' }}" href="{{ url('/definitions/discounts'); }}">
                            <i class="fa fa-percent text-primary"></i>
                            <span class="nav-link-text">Discounts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/hotels*') ? 'active' : '' }}" href="{{ url('/definitions/hotels'); }}">
                            <i class="fa fa-hospital-o text-primary"></i>
                            <span class="nav-link-text">Hotels</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/payments*') ? 'active' : '' }}" href="{{ url('/definitions/payments'); }}">
                            <i class="fa fa-credit-card-alt text-primary"></i>
                            <span class="nav-link-text">Payments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/reservations*') ? 'active' : '' }}" href="{{ url('/definitions/reservations'); }}">
                            <i class="fa fa-check text-primary"></i>
                            <span class="nav-link-text">Reservations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/sources*') ? 'active' : '' }}" href="{{ url('/definitions/sources'); }}">
                            <i class="fa fa-tasks text-primary"></i>
                            <span class="nav-link-text">Source Of Booking</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/services*') ? 'active' : '' }}" href="{{ url('/definitions/services'); }}">
                            <i class="fa fa-sun-o text-primary"></i>
                            <span class="nav-link-text">Services</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/therapists*') ? 'active' : '' }}" href="{{ url('/definitions/therapists'); }}">
                            <i class="fa fa-users text-primary"></i>
                            <span class="nav-link-text">Therapists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/users*') ? 'active' : '' }}" href="{{ url('/definitions/users'); }}">
                            <i class="fa fa-cogs text-primary"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                    </li>
                </ul>
                <hr class="my-3">
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Reports</span>
                </h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link menu-item " href="{{ url('definitions/reports') }}">
                            <i class="fa fa-users text-primary"></i>
                            <span class="nav-link-text">General Report</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
