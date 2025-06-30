<div
    class="floating-button-container d-flex d-md-none d-lg-none {{ request()->is('campaign/*', 'event/*', 'zakat-maal', 'kurban/*', 'zakat-fitrah') ? ' d-none' : '' }}">
    <button class="floating-button" onclick="window.location=`{{ route('zakat-calculator.index') }}`">
        <i class="fas fa-calculator"></i>
    </button>
</div>

<nav
    class="nav-mobile d-flex d-md-none d-lg-none {{ request()->is('campaign/*', 'event/*', 'zakat-maal', 'kurban/*', 'zakat-fitrah') ? ' d-none' : '' }}">
    <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        Beranda
    </a>
    <a href="{{ route('campaign.index') }}" class="{{ request()->is('campaign') ? 'active' : '' }}">
        <i class="fas fa-search"></i>
        Campaign
    </a>
    <div></div>
    <a href="{{ route('zakat-maal') }}" class="{{ request()->is('zakat') ? 'active' : '' }}">
        <i class="fas fa-hand-holding-heart"></i>
        Zakat
    </a>

    <a href="{{ route('donatur.profile') }}" class="{{ request()->is('donatur*') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        Akun
    </a>
</nav>
