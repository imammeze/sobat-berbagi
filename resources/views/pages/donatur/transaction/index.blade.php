<x-layouts.donatur title="Riwayat Transaksi Saya">
    @push('styles')
        <style>
            #lottie {
                width: 300px;
                margin: auto
            }
        </style>
    @endpush
    <x-slot name="addOn">
        <x-frontend.header-mobile back-link="{{ route('donatur.profile') }}" back-link-text="Riwayat Transaksi" />
    </x-slot>
    <div class="row mt-3 p-3">
        <div class="col-12">
            <h5>Riwayat Transaksi</h5>
            <hr>
            <div class="d-flex flex-column gap-3">
                @forelse ($campaignDonations as $campaignDonation)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div
                                    class="badge bg-{{ $campaignDonation->status == 'success' ? 'success' : 'warning' }} mb-3">
                                    {{ \Str::ucfirst($campaignDonation->status) }}
                                </div>
                                <p>
                                    <i class="bi bi-calendar-check"></i>
                                    {{ $campaignDonation->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <h6 class="card-title">{{ $campaignDonation->campaign->title ?? 'Zakat Maal' }}</h6>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <p class="fw-bold float-end">
                                        {{ $campaignDonation->formatted_amount }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                        <div id="lottie"></div>
                        <p>
                            Anda belum memiliki riwayat transaksi.
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            Donasi Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
        <script>
            var animation = bodymovin.loadAnimation({
                container: document.getElementById('lottie'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('frontend/assets/lottie/not-found.json') }}'
            })
        </script>
    @endpush
</x-layouts.donatur>
