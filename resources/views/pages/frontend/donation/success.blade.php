<x-layouts.frontend title="Pembayaran Donasi {{ $campaign->title }}">
    @push('styles')
        <style>
            #lottie {
                width: 300px;
                margin: auto
            }
        </style>
    @endpush

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div id="lottie"></div>
                        </div>
                        <h3 class="text-center mt-3">
                            Pembayaran Donasi Anda Berhasil
                        </h3>
                        <a href="{{ route('donatur.transaction') }}" class="btn btn-primary d-block mt-3">
                            Lihat Transaksi
                        </a>
                    </div>
                </div>
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
                path: '{{ asset('frontend/assets/lottie/140285-success.json') }}'
            })
        </script>
    @endpush

</x-layouts.frontend>
