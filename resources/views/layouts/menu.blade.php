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
                        <a class="nav-link {{ request()->is('home*') ? 'active' : '' }}" href="{{ route('home'); }}">
                            <i class="fa fa-pie-chart text-primary"></i>
                            <span class="nav-link-text">Arayüz</span>
                        </a>
                    </li>
                    @can('show customers')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.index'); }}">
                            <i class="fa fa-users text-primary"></i>
                            <span class="nav-link-text">Müşteriler</span>
                        </a>
                    </li>
                    @endcan
                    @can('show contactform')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-wpforms text-primary"></i>
                            <span class="nav-link-text">Formlar</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('contactform.index', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span>İletişim Formları</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bookingform.index', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span>Rezervasyon Formları</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('whatsapp.index'); }}">
                                    <span>Whatsapp Formları</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('show reservation')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-calendar text-primary"></i>
                            <span class="nav-link-text">Takvimler</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('reservation.calendar') }}">
                                    <span>Rezervasyon Takvimi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-tasks text-primary"></i>
                            <span class="nav-link-text">Tanımlamalar</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            @can('show form statuses')
                            <li>
                                <a href="{{ route('formstatus.index'); }}">
                                    <span>Form Durumları</span>
                                </a>
                            </li>
                            @endcan
                            @can('show discount')
                            <li>
                                <a href="{{ route('discount.index'); }}">
                                    <span>İndirimler</span>
                                </a>
                            </li>
                            @endcan
                            @can('show hotel')
                            <li>
                                <a href="{{ route('hotel.index'); }}">
                                    <span>Oteller</span>
                                </a>
                            </li>
                            @endcan
                            @can('show payment type')
                            <li>
                                <a href="{{ route('paymenttype.index'); }}">
                                    <span>Ödeme Türleri</span>
                                </a>
                            </li>
                            @endcan
                            @can('show sources')
                            <li>
                                <a href="{{ route('source.index'); }}">
                                    <span>Rezervasyon Kaynakları</span>
                                </a>
                            </li>
                            @endcan
                            @can('show guides')
                            <li>
                                <a href="{{ route('guide.index'); }}">
                                    <span>Rehberler</span>
                                </a>
                            </li>
                            @endcan
                            @can('show services')
                            <li>
                                <a href="{{ route('service.index'); }}">
                                    <span>Hizmetler</span>
                                </a>
                            </li>
                            @endcan
                            @can('show therapist')
                            <li>
                                <a href="{{ route('therapist.index'); }}">
                                    <span>Terapistler</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-file-text text-primary"></i>
                            <span class="nav-link-text">Raporlar</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('report.index', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span>Genel Rapor</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('report.reservation', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span>Rezervasyon Raporu</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('report.payment', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span>Ciro Raporu</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('report.comission', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span>Komisyon Raporu</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-check text-primary"></i>
                            <span class="nav-link-text">Rezervasyonlar</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('reservation.create') }}">
                                    <span>Yeni Rezervasyon</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('reservation.index', ['startDate' => date("Y-m-d"), 'endDate' => date("Y-m-d")]) }}">
                                    <span>Rezervasyon Listesi</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @can('show users')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-user text-primary"></i>
                            <span class="nav-link-text">Kullanıcılar</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('role.index'); }}">
                                    <span>Roller</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.index'); }}">
                                    <span>Tüm Kullanıcılar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                </ul>
                <hr class="my-3">
            </div>
        </div>
    </div>
</nav>
