<nav id="navbar"
    class="navbar navbar-expand-lg {{ request()->is('kontak-kami', 'tim-kami', 'visi-misi', 'donasi/*/metode-pembayaran', 'donasi/*/konfirmasi', 'donatur*', 'campaign/*', 'event/*', 'berita/*', 'kurban/*') ? 'd-none d-sm-none d-md-flex d-lg-flex' : '' }}">
    <div class="container py-2 d-block d-sm-block d-md-none d-lg-none">

        <div class="row align-items-center  w-100">
            <div class="col-3">
                <img src="{{ asset('admin/assets/images/logo-sobat-berbagi-2025.png') }}" alt="logo" width="80"
                    onclick="window.location.href='{{ route('home') }}'">
            </div>
            <div class="col-9">
                <form action="{{ route('campaign.index') }}" method="GET">
                    <input type="text" class="form-control form-search" placeholder="Ingin bantu apa.."
                        name="search">
                </form>
            </div>
        </div>
    </div>
    <div class="nav-desktop container py-2 d-none d-sm-none d-md-flex d-lg-flex">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('admin/assets/images/logo-sobat-berbagi-2025.png') }}" alt="logo" width="100"
                onclick="window.location.href='{{ route('home') }}'">
        </a>
        <button class="navbar-toggler d-none d-md-block d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-lg-0 gap-3">
                <li class="nav-item">
                    <a class="nav-link cursor-pointer" id="btn-search">Cari<i class="bi bi-search ms-2"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu dropdown-category p-2">
                        <li>
                            <a class="dropdown-item rounded" href="{{ route('campaign.index') }}">
                                <div class="d-flex p-1">
                                    <img src="{{ asset('frontend/assets/images/donasi-logo.svg') }}" alt="">
                                    <div class="info w-100">
                                        <h1>Donasi</h1>
                                        <p>Aksi kebaikan sederhana, ulurkan <br> tangan untuk meringankan beban <br>
                                            mereka.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded" href="{{ route('zakat-maal') }}">
                                <div class="d-flex p-1">
                                    <img src="{{ asset('frontend/assets/images/zakat-logo.svg') }}" alt="">
                                    <div class="info w-100">
                                        <h1>Zakat Maal</h1>
                                        <p>
                                            Mengumpulkan dana untuk <br> kebaikan yang ada di <br> Indonesia
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded" href="{{ route('zakat-fitrah') }}">
                                <div class="d-flex p-1">
                                    <img src="{{ asset('frontend/assets/images/zakat-logo.svg') }}" alt="">
                                    <div class="info w-100">
                                        <h1>Zakat Fitrah</h1>
                                        <p>
                                            Zakat Fitrah adalah zakat yang <br> dikeluarkan pada bulan Ramadhan <br>
                                            untuk
                                            membantu meringankan <br> beban orang-orang yang <br> membutuhkan.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item rounded" href="{{ route('kurban.index') }}">
                                <div class="d-flex p-1">
                                    <img src="{{ asset('frontend/assets/images/kurban-logo.svg') }}" alt="">
                                    <div class="info w-100">
                                        <h1>Kurban</h1>
                                        <p>
                                            Mengumpulkan dana untuk <br> kebaikan yang ada di <br> Indonesia

                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('zakat-calculator.index') }}">Kalkulator Zakat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mitra') ? ' active' : '' }}"
                        href="{{ route('mitra.index') }}">Mitra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('event.index') }}">Event</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  {{ request()->is('kontak-kami', 'tim-kami', 'visi-misi') ? ' active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm p-1">
                        <li><a class="dropdown-item rounded-1 {{ request()->is('profil-kami') ? ' active' : '' }}"
                                href="{{ route('about-us') }}">Profil Kami</a></li>
                        <li><a class="dropdown-item rounded-1 {{ request()->is('visi-misi') ? ' active' : '' }}"
                                href="{{ route('vision-mission') }}">Visi Misi</a></li>
                        <li><a class="dropdown-item rounded-1 mt-1 {{ request()->is('tim-kami') ? ' active' : '' }}"
                                href="{{ route('team') }}">Tim Kami</a></li>
                        <li><a class="dropdown-item rounded-1 mt-1 {{ request()->is('kontak-kami') ? ' active' : '' }}"
                                href="{{ route('contact') }}">Kontak Kami</a></li>
                    </ul>
                </li>
            </ul>
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-auth login me-2">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-auth register">
                    Daftar
                </a>
            @else
                <div class="position-relative ">
                    @if (Auth::check())
                        @hasrole('donatur')
                            <div class="avatar" style="background-image: url({{ asset(Auth::user()->profile->avatar) }});"
                                id="avatar"></div>
                        @endhasrole
                        @hasrole('superadmin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">Go to Admin Dashboard</a>
                        @endhasrole
                        @hasrole('manager-campaign')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Go to Admin Dashboard</a>
                        @endhasrole
                        @hasrole('mitra')
                            <a href="{{ route('mitra.dashboard') }}" class="nav-link">Go to Mitra Dashboard</a>
                        @endhasrole
                        @hasrole('finance')
                            <a href="{{ route('finance.dashboard') }}" class="nav-link">Go to Finance Dashboard</a>
                        @endhasrole
                        @hasrole('direktur')
                            <a href="{{ route('direktur.dashboard') }}" class="nav-link">Go to Direktur Dashboard</a>
                        @endhasrole
                    @endif

                    <div class="card modal-user shadow-lg d-none">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center px-3 pt-3">
                                @hasrole('donatur')
                                    <div class="avatar"
                                        style="background-image: url({{ asset(Auth::user()->profile->avatar) }});"
                                        id="avatar"></div>
                                @endhasrole

                                @auth
                                    @hasrole('donatur')
                                        <div class="ms-3">
                                            <h6 class="name">{{ Auth::user()->profile->name }}</h6>
                                        </div>
                                    @endhasrole
                                @endauth
                            </div>
                            <hr class="line">
                            <ul>
                                <li class="px-3 py-2">
                                    <a href="{{ route('donatur.dashboard') }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="px-3 py-2">
                                    <a href="{{ route('donatur.transaction') }}">
                                        Riwayat Transaksi
                                    </a>
                                </li>
                                <li class="px-3 py-2">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        Keluar
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>

    <div id="search-wrap">
        <div id="search" class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('campaign.index') }}" method="GET">
                        <div class="row form-search-nav">
                            <div class="col-12">
                                <div class="search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control" placeholder="Cari" name="search">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
