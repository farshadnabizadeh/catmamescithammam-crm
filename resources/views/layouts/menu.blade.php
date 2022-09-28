<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="{{ route('home'); }}">
                <img class="navbar-brand-img" src="{{ asset('assets/img/logo.png') }}" alt="">
            </a>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home'); }}">
                            <i class="fa fa-pie-chart text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    @can('show approval calendar')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-calendar text-primary"></i>
                            <span class="nav-link-text">Calendars</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            @can('show approval calendar')
                            <li>
                                <a href="{{ route('approval_calendar.index'); }}">
                                    <span>Approval Calendar</span>
                                </a>
                            </li>
                            @endcan
                            @can('show approval calendar')
                            <li>
                                <a href="{{ route('operation_calendar.index'); }}">
                                    <span>Operation/Surgery Calendar</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('show patient')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-id-badge text-primary"></i>
                            <span class="nav-link-text">Patients</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            @can('show patient')
                            <li>
                                <a href="{{ route('patient.index'); }}">
                                    <span>Choose From List</span>
                                </a>
                            </li>
                            @endcan
                            @can('create patient')
                            <li>
                                <a href="{{ route('patient.create'); }}">
                                    <span>New Patient</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('show treatment')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-stethoscope text-primary"></i>
                            <span class="nav-link-text">Treatments</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('treatment.index'); }}">
                                    <span>Treatments</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-files-o text-primary"></i>
                            <span class="nav-link-text">Treatment Plans</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            @can('show requested treatment plan')
                            <li>
                                <a href="{{ route('treatmentplan.requested'); }}">
                                    <span>Requested Plans</span>
                                </a>
                            </li>
                            @endcan
                            @can('show reconsult treatment plan')
                            <li>
                                <a href="{{ route('treatmentplan.reconsult'); }}">
                                    <span>Re Consult Requests</span>
                                </a>
                            </li>
                            @endcan
                            @can('show completed treatment plan')
                            <li>
                                <a href="{{ route('treatmentplan.completed'); }}">
                                    <span>Completed Plans</span>
                                </a>
                            </li>
                            @endcan
                            @can('create treatment plan')
                            <li>
                                <a href="{{ route('treatmentplan.create'); }}">
                                    <span>Create New Request</span>
                                </a>
                            </li>
                            @endcan
                            @can('show ticket received')
                            <li>
                                <a href="{{ route('treatmentplan.ticketreceived'); }}">
                                    <span>Ticket Received List</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @can('show users')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-user text-primary"></i>
                            <span class="nav-link-text">Users</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            @can('show users')
                            <li>
                                <a href="{{ route('user.index'); }}">
                                    <span>All Users</span>
                                </a>
                            </li>
                            @endcan
                            @can('show roles')
                            <li>
                                <a href="{{ route('role.index'); }}">
                                    <span>Roles</span>
                                </a>
                            </li>
                            @endcan
                            @can('show user report')
                            <li>
                                <a href="#">
                                    <span>Reports</span>
                                </a>
                            </li>
                            @endcan
                            @can('show logs')
                            <li>
                                <a href="{{ url('logs'); }}">
                                    <span>User Activity</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('show agent')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-tasks text-primary"></i>
                            <span class="nav-link-text">Definitions</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            @can('show agent')
                            <li>
                                <a href="{{ route('agent.index') }}">
                                    <span>Agents</span>
                                </a>
                            </li>
                            @endcan
                            @can('show country')
                            <li>
                                <a href="{{ route('country.index'); }}">
                                    <span>Countries</span>
                                </a>
                            </li>
                            @endcan
                            @can('show discount')
                            <li>
                                <a href="{{ route('discount.index'); }}">
                                    <span>Discounts</span>
                                </a>
                            </li>
                            @endcan
                            @can('show lead source')
                            <li>
                                <a href="{{ route('leadsource.index'); }}">
                                    <span>Lead Sources</span>
                                </a>
                            </li>
                            @endcan
                            @can('show medical department')
                            <li>
                                <a href="{{ route('medicaldepartment.index'); }}">
                                    <span>Medical Department</span>
                                </a>
                            </li>
                            @endcan
                            @can('show medical sub department')
                            <li>
                                <a href="{{ route('medicalsubdepartment.index'); }}">
                                    <span>Medical Sub-Department</span>
                                </a>
                            </li>
                            @endcan
                            @can('show sales person')
                            <li>
                                <a href="{{ route('salesperson.index'); }}">
                                    <span>Sales Agents</span>
                                </a>
                            </li>
                            @endcan
                            @can('show treatment plan status')
                            <li>
                                <a href="{{ route('treatmentplanstatus.index'); }}">
                                    <span>Treatment Plan Status</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                        @endcan
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
