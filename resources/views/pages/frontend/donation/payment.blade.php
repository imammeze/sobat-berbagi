<x-layouts.frontend title="Pembayaran Donasi {{ $campaign->title }}">

    @push('styles')
        <style>
            .payment-method-logo {
                width: 40px;
                height: 40px;
                object-fit: contain;
            }

            .payment-method-card {
                padding: 8px;
                border-radius: 8px;
                background: #F8F8F8;
                border: none
            }
        </style>
    @endpush

    <x-frontend.header-mobile back-link-text=" Pembayaran" />

    <div class="container vh-100">
        <div class="d-flex align-items-center gap-3">
            <h6>Transfer Bank</h6>
            <img src="{{ $paymentMethod->logo }}" alt="{{ $paymentMethod->name }}" class="payment-method-logo">
        </div>

        <div class="card payment-method-card mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="information">
                        <p class="fw-bold">{{ $paymentMethod->name }}</p>
                        <h5>{{ $paymentMethod->number }}</h5>
                    </div>
                    <button type="button" class="btn btn-outline-primary rounded-5" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Salin nomor rekening"
                        onclick="copyToClipboard('{{ $paymentMethod->number }}')">
                        Salin
                    </button>
                </div>
            </div>
        </div>

        <div class="card mt-3 border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="information">
                    <p class="fw-bold">Jumlah Donasi</p>
                    <h4 class="text-primary mt-1">
                        Rp. {{ number_format($donation->amount) }}
                    </h4>
                </div>

                <button type="button" class="btn btn-outline-primary rounded-5" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Salin jumlah donasi"
                    onclick="copyToClipboard('{{ $donation->amount }}')">
                    Salin
                </button>
            </div>
        </div>

        <form action="{{ route('donation.payment.store', [$campaign->slug, $donation->id]) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            <x-input.file label="Bukti Pembayaran" name="proof" />
            <button type="submit" class="btn btn-primary w-100 rounded-5">
                Konfirmasi
            </button>
        </form>
    </div>

    @push('custom-scripts')
        <script>
            if ($(window).width() < 768) {
                $('#navbar').remove();
            }
        </script>
        <script>
            function copyToClipboard(text) {
                var text = text;

                if (navigator.clipboard) {
                    navigator.clipboard.writeText(text).then(function() {
                        alert('Jumlah donasi berhasil disalin');
                    }, function(err) {
                        console.error('Async: Could not copy text: ', err);
                    });
                } else {
                    alert('Browser tidak mendukung fitur ini');
                }
            }
        </script>
    @endpush

</x-layouts.frontend>
