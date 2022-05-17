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
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-calendar text-primary"></i>
                            <span class="nav-link-text">Calendars</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a class="" href="{{ url('/definitions/reservations/calendar') }}">
                                    <span>Reservation Calendar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->is('definitions/customers*') || request()->is('definitions/contactforms*') || request()->is('definitions/discounts*') || request()->is('definitions/hotels*') || request()->is('definitions/payment_types*') || request()->is('definitions/sources*') || request()->is('definitions/services*') || request()->is('definitions/therapists*') ? 'active' : '' }}">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-tasks text-primary"></i>
                            <span class="nav-link-text">Definitions</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a class="{{ request()->is('definitions/customers*') ? 'active' : '' }}" href="{{ url('/definitions/customers'); }}">
                                    <span>Customers</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/contactforms*') ? 'active' : '' }}" href="{{ url('/definitions/contactforms'); }}">
                                    <span>Contact Forms</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/discounts*') ? 'active' : '' }}" href="{{ url('/definitions/discounts'); }}">
                                    <span>Discounts</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/hotels*') ? 'active' : '' }}" href="{{ url('/definitions/hotels'); }}">
                                    <span>Hotels</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/payment_types*') ? 'active' : '' }}" href="{{ url('/definitions/payment_types'); }}">
                                    <span>Payment Types</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/sources*') ? 'active' : '' }}" href="{{ url('/definitions/sources'); }}">
                                    <span>Source Of Booking</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/services*') ? 'active' : '' }}" href="{{ url('/definitions/services'); }}">
                                    <span>Services</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/therapists*') ? 'active' : '' }}" href="{{ url('/definitions/therapists'); }}">
                                    <span>Therapists</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->is('definitions/reservations/create*') || request()->is('definitions/reservations*') ? 'active' : '' }}">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-check text-primary"></i>
                            <span class="nav-link-text">Reservations</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a class="{{ request()->is('definitions/reservations/create*') ? 'active' : '' }}" href="{{ url('/definitions/reservations/create') }}">
                                    <span>New Reservation</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('definitions/reservations*') ? 'active' : '' }}" href="{{ url('/definitions/reservations') }}">
                                    <span>Reservation List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('definitions/users*') ? 'active' : '' }}" href="{{ url('/definitions/users'); }}">
                            <i class="fa fa-user text-primary"></i>
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
