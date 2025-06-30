<nav class="sidebar">
    <div class="sidebar-header">

        <img src="{{ asset('admin/assets/images/logo-laziz.png') }}" class="sidebar-brand" width="40">
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->is('mitra/dashboard') ? ' active' : '' }}">
                <a href="{{ route('mitra.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->mitraRelation->status == 'verified')
                <li class="nav-item {{ request()->is('mitra/campaign*') ? ' active' : '' }}">
                    <a href="{{ route('mitra.campaign.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="heart"></i>
                        <span class="link-title">Campaign Saya</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('mitra/transaksi*') ? ' active' : '' }}">
                    <a href="{{ route('mitra.transaction.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Transaksi Campaign</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('mitra/kabar-penggunaan-dana*') ? ' active' : '' }}">
                    <a href="{{ route('mitra.campaign-latest-news.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Kabar Penggunaan Dana</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
