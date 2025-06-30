<div class="sidebar d-flex flex-column align-items-center align-items-sm-start  pt-2 min-vh-100 position-fixed bottom-0">
    <div class="d-flex align-items-center pb-3 mb-md-0 me-md-auto" style="margin-top: 130px;">
        <img src="{{ asset(Auth::user()->profile->avatar) }}" alt="Logo" class="me-2"
            style="object-fit: cover; object-position: center; width: 45px; height: 45px; border-radius: 50%;">
        <div class="d-flex flex-column">
            <h6 class="mb-0">{{ \Str::limit(Auth::user()->donaturRelation->name, 15) }}</h6>
            <p>
                {{ Auth::user()->email }}
            </p>
        </div>
    </div>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
        <li class="nav-item">
            <a href="{{ route('donatur.dashboard') }}"
                class="nav-link d-flex align-items-center flex-start px-0 {{ request()->is('donatur/dashboard') ? 'active' : '' }}">
                <i class="fs-4 bi-house"></i> <span class="ms-2 d-none d-sm-inline">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('donatur.transaction') }}"
                class="nav-link d-flex align-items-center flex-start px-0 {{ request()->is('donatur/riwayat-transaksi') ? 'active' : '' }}">
                <i class="fs-4 bi-credit-card-2-front"></i> <span class="ms-2 d-none d-sm-inline">Riwayat
                    Transaksi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('donatur.profile') }}"
                class="nav-link d-flex align-items-center flex-start px-0 {{ request()->is('donatur/profile') ? 'active' : '' }}">
                <i class="fs-4 bi-person"></i> <span class="ms-2 d-none d-sm-inline">
                    Profil
                </span>
            </a>
        </li>
    </ul>
</div>
