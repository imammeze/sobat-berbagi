<x-layouts.frontend title="Pembayaran Donasi {{ $campaign->title }}">
    @push('styles')
        <style>
            body {
                overflow-x: hidden;
            }

            #qrcode {
                background-color: #FFFFFF;
                padding: 1rem;
                border: 1px solid #fd7e14;
                border-radius: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    @endpush


    <x-frontend.header-mobile back-link-text=" Pembayaran" />

    <div class="container vh-100">
        <div class="d-flex">
            <h6>Scan QR Code</h6>
        </div>
        <div class="d-flex justify-content-center mt-3 flex-column ">
            <div id="qrcode"></div>

            <p class="fw-bold mt-3">Jumlah Donasi</p>
            <h4 class="text-primary">
                Rp. {{ number_format($donation->amount, 0, ',', '.') }}
            </h4>
        </div>
        <x-button.primary id="check-payment" class="rounded-5 w-100 mt-3">
            Cek Status Pembayaran
        </x-button.primary>

        <p class="fw-bold mt-3">Panduan pembayaran</p>
        <p>
            1. Scan QR code diatas
        </p>
        <p>
            2. Buka aplikasi bank/dompet digital (Gojek, OVO, Dana, QRIS BCA, dll).
        </p>
        <p>
            3. Pilih ‘Pay’ atau ‘Scan’
        </p>
        <p>
            4. Upload tangkapan layar (screenshot) QR Code.
        </p>
        <p>
            5. Masukkan kode PIN dompet digitalmu.
        </p>
        <p>
            6. Jika pembayaran telah selesai dan berhasil, kamu akan mendapat notifikasi.
        </p>
    </div>


    @push('custom-scripts')
        <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <script>
            if ($(window).width() < 768) {
                $('#navbar').remove();
            }
        </script>
        <script>
            $(document).ready(function() {
                var qrCodeData = "{{ $qrCode }}";

                displayQRCode(qrCodeData);

                function displayQRCode(qrCodeData) {
                    var qr = new QRCode(document.getElementById("qrcode"), {
                        text: qrCodeData,
                        width: 300,
                        height: 300,
                    });

                }
                $('#qrcode').attr('title', 'Scan me!');
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#download-qris').on('click', function() {
                    html2canvas(document.querySelector("#qrcode")).then(canvas => {
                        var image = canvas.toDataURL("image/png").replace("image/png",
                            "image/octet-stream");
                        var link = document.createElement('a');
                        link.download = "qris.png";
                        link.href = image;
                        link.click();
                    });
                });
            });
        </script>
        <script>
            function checkPayment() {
                $.ajax({
                    url: '/api/check-payment',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        transaction_id: '{{ $donation->id }}',
                        invoice_id: '{{ $invoiceId }}',
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.data.qris_status);

                        if (data.data.qris_status == 'paid') {
                            window.location.href =
                                '{{ route('donation.success', [$campaign->slug, $donation->id]) }}';
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            $(document).ready(function() {
                $('#check-payment').on('click', function() {
                    checkPayment();
                });

                setInterval(function() {
                    checkPayment();
                }, 5000);
            });
        </script>
    @endpush

</x-layouts.frontend>
