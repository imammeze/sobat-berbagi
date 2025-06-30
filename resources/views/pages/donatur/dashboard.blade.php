<x-layouts.donatur title="Dashboard">
    @push('styles')
        <style>
            .icon-card {
                width: 50px;
                height: 50px;
            }
        </style>
    @endpush


    <x-slot name="addOn">
        <x-frontend.header-mobile back-link="{{ route('donatur.profile') }}" back-link-text="Dashboard" />
    </x-slot>

    <div class="row mt-3 p-3 align-items-center">
        <div class="col-6">
            <h4 class="fw-bold">Dashboard</h4>
        </div>

        <div class="col-6 text-end">
            <p>*Akumulasi Per Tahun</p>
        </div>
    </div>

    <div class="row p-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-4 mt-3 mt-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <img src="{{ asset('frontend/assets/ic-donasi.svg') }}" alt="Donasi" class="icon-card">
                    <div class="information">
                        <p class="fw-bold">
                            Donasi
                        </p>
                        <h4 class="amount text-primary">
                            Rp.
                            {{ number_format(Auth::user()->donations->where('status', 'success')->where('created_at', '>=', now()->year . '-01-01')->sum('amount'),0,',','.') }}

                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-4 mt-3 mt-lg-0">
            <div class="card border-0 shadow-sm ">
                <div class="card-body d-flex align-items-center gap-3">
                    <img src="{{ asset('frontend/assets/images/ic-zakat.svg') }}" alt="Zakat" class="icon-card">
                    <div class="information">
                        <p class="fw-bold">
                            Zakat
                        </p>
                        <h4 class="amount text-primary">
                            Rp.{{ number_format(Auth::user()->zakats->where('status', 'success')->where('created_at', '>=', now()->year . '-01-01')->sum('amount'),0,',','.') }}

                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.donatur>
