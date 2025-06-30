<div class="card card-zakat border-0" onclick="window.location.href='{{ $attributes->get('url') }}'">
    <img src="{{ $attributes->get('img') }}" alt="{{ $attributes->get('title') }}">
    <div class="card-body p-2">
        <h5 class="card-title">
            {{ $attributes->get('title') }}
        </h5>
        <div class="d-flex align-items-center gap-3 mt-3">
            <img src="{{ asset('admin/assets/images/logo-laziz.png') }}" alt="logo-mitra" width="40">
            <p>Lazismu banyumas</p>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <div class="d-flex flex-column">
                <p>Terkumpul</p>
                <h1 class="amount">
                    Rp. {{ number_format($attributes->get('amount'), 0, ',', '.') }}
                </h1>
            </div>
            <div class="d-flex flex-column">
                <p>Donatur</p>
                <p class="fw-bold">{{ $attributes->get('donatur') }}</p>
            </div>
        </div>
    </div>
</div>
