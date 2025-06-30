<x-layouts.frontend title="Metode Pembayaran">
    @push('styles')
        <style>
            .payment-method-card {
                cursor: pointer;
            }

            .payment-method-card.active {
                border: 2px solid #0d6efd;
            }
        </style>
    @endpush

    <x-frontend.header-mobile
        back-link-text="Pilih Metode Pembayaran" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="mb-3">
                    <div class="d-flex flex-column mb-3 gap-3">
                        @foreach ($paymentMethods as $paymentMethod)
                            <div class="card card-metode-pembayaran border-0" style="background-color: #F6F7F9"
                                data-payment-method-id="{{ $paymentMethod->id }}"
                                data-payment-method-name="{{ $paymentMethod->name }}"
                                data-payment-method-logo="{{ $paymentMethod->logo }}"
                                data-payment-method-code="{{ $paymentMethod->code }}">
                                <div class="card-body p-2 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset($paymentMethod->logo) }}"
                                                alt="{{ $paymentMethod->name }}" width="80" class="rounded-2">
                                            <h6 class="fw-bold mb-0">{{ $paymentMethod->name }}</h6>
                                        </div>
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('custom-scripts')
        <script>
            const paymentMethodCards = document.querySelectorAll('.card-metode-pembayaran');
            paymentMethodCards.forEach(paymentMethodCard => {
                paymentMethodCard.addEventListener('click', () => {
                    var paymentMethodId = paymentMethodCard.getAttribute('data-payment-method-id');
                    var paymentMethodName = paymentMethodCard.getAttribute('data-payment-method-name');
                    var paymentMethodLogo = paymentMethodCard.getAttribute('data-payment-method-logo');
                    var paymentMethodCode = paymentMethodCard.getAttribute('data-payment-method-code');

                    var sacrifice = JSON.parse(localStorage.getItem('sacrifice'));

                    sacrifice.payment_method_id = paymentMethodId;
                    sacrifice.payment_method_name = paymentMethodName;
                    sacrifice.payment_method_logo = paymentMethodLogo;
                    sacrifice.payment_method_code = paymentMethodCode;

                    localStorage.setItem('sacrifice', JSON.stringify(sacrifice));

                    window.location.href = "{{ route('kurban.confirmation', $slug) }}";
                });
            });
        </script>
    @endpush

</x-layouts.frontend>
