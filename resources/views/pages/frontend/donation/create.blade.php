<x-layouts.frontend title="Donasi {{ $campaign->title }}">
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="card shadow-sm border-0" style="background-color: #F6F7F9">
                    <div class="card-body">
                        <form action="{{ route('donation.store', $campaign->slug) }}" method="POST">
                            @csrf
                            @php
                                $isEvent = isset($campaign) && $campaign->type === 'event';
                                $fixedAmount = $isEvent ? $campaign->fixed_amount : null;
                            @endphp

                            <x-input.text 
                                label="Nominal Donasi" 
                                id="amount" 
                                value="Rp {{ number_format($fixedAmount ?? 1000, 0, ',', '.') }}"
                                placeholder="Masukkan nominal donasi dalam bentuk angka contoh: 10000"
                                :disabled="$isEvent && $fixedAmount !== null"
                            />

                            <input type="hidden" name="amount" id="amount-hidden" value="{{ $fixedAmount ?? 1000 }}">

                            <div class="d-flex mb-3 gap-2 flex-wrap" id="amount-buttons">
                                @php
                                    $nominals = [];
                                    if ($isEvent) {
                                        // Tambahkan nominal tambahan khusus untuk event
                                        $nominals = [10000, 40000, 50000, 80000, 100000, 200000];
                                    } else {
                                        $nominals = [10000, 50000, 100000, 300000, 500000, 1000000];
                                    }
                                @endphp

                                @foreach($nominals as $nominal)
                                    <button type="button" 
                                        class="btn btn-outline-secondary btn-sm amount-btn" 
                                        data-amount="{{ $nominal }}"
                                        @if($isEvent && $fixedAmount !== null && $nominal <= $fixedAmount) disabled @endif>
                                        {{ number_format($nominal, 0, ',', '.') }}
                                    </button>
                                @endforeach
                            </div>
                                                        <div class="mb-3">
                                <label for="message" class="form-label">Pesan Dukungan</label>
                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                <div class="form-text">
                                    <span class="text-muted" id="totalMessage">0</span>/120
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="payment_method_id" class="form-label">Metode Pembayaran</label>
                                @error('payment_method_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="payment_method_id" id="payment_method_id" value="{{ $paymentMethods->where('name', 'QRIS')->first()->id ?? '' }}">
                                @foreach ($paymentMethods as $paymentMethod)
                                    <div class="card mb-3 payment-method-card {{ $paymentMethod->name === 'QRIS' ? 'selected active' : '' }}"
                                        id="payment-method-{{ $paymentMethod->id }}"
                                        data-payment-method-id="{{ $paymentMethod->id }}"
                                        data-payment-method-name="{{ $paymentMethod->name }}"
                                        data-payment-method-code="{{ $paymentMethod->code }}">
                                        <div class="card-body d-flex gap-3 align-items-center">
                                            <img src="{{ $paymentMethod->logo }}" alt="{{ $paymentMethod->name }}"
                                                width="100" class="rounded-2">
                                            <div class="information">
                                                @if($paymentMethod->name === 'QRIS')<div class="d-inline-flex">@endif
                                                    <h4 class="card-title mb-0">
                                                        {{ $paymentMethod->name }}
                                                    </h4>
                                                    @if($paymentMethod->name === 'QRIS')
                                                    <span class="badge bg-success text-center my-auto">Recommended</span>
                                                    @endif
                                                @if($paymentMethod->name === 'QRIS')</div>@endif
                                                
                                                <p class="card-text">
                                                    {{ $paymentMethod->number }} an {{ $paymentMethod->owner }}
                                                </p>
                                                @if($paymentMethod->name === 'QRIS')
                                                <br>
                                                <p class="card-text text-grey">
                                                    *Biaya administrasi sebesar 0.7% akan dikenakan pada setiap transaksi donasi.
                                                </p>            
                                                @endif                                    
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <x-form.switches name="is_anonymous" label="Sembunyikan nama saya (Hamba Allah)"
                                mb="3" value="1" id="is_anonymous" />
                            <x-button.primary class="w-100 mt-3" type="submit">
                                Donasi Sekarang
                            </x-button.primary>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('custom-scripts')

    <script>
        $(document).ready(function () {
            let isEvent = "{{ $isEvent ? 'true' : 'false' }}" === "true";
            let fixedAmount = "{{ $fixedAmount ?? '' }}";
            fixedAmount = fixedAmount ? parseInt(fixedAmount) : null;
    
            let $amountInput = $("#amount");
            let $hiddenAmountInput = $("#amount-hidden");
            let $amountButtons = $("#amount-buttons button");
    
            // Jika campaign event dan ada fixedAmount, disable tombol nominal di bawah atau sama dengan fixedAmount
            if (isEvent && fixedAmount !== null) {
                $amountButtons.each(function () {
                    let value = parseInt($(this).text().replace(/\D/g, "")); // Ambil angka dari teks tombol
                    if (value <= fixedAmount) {
                        $(this).prop("disabled", true);
                    }
                });
    
                // Input amount hanya disable jika ada fixedAmount
                $amountInput.prop("disabled", true);
            }
    
            // Event klik untuk memilih nominal donasi
            $amountButtons.on("click", function () {
                if (!$(this).prop("disabled")) {
                    let value = $(this).text().replace(/\D/g, ""); // Ambil angka dari teks tombol
                    $amountInput.val(`Rp ${new Intl.NumberFormat("id-ID").format(value)}`);
                    $hiddenAmountInput.val(value);
                }
            });
        });
    </script>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethods = document.querySelectorAll('.payment-method-card');
            let defaultPaymentMethod = null;
    
            // Set QRIS as the default payment method
            paymentMethods.forEach(function(card) {
                const methodCode = card.getAttribute('data-method-code');
                if (methodCode === 'qris') {
                    defaultPaymentMethod = card;
                }
            });
    
            if (defaultPaymentMethod) {
                // Mark QRIS as selected by default
                defaultPaymentMethod.classList.add('selected');
                document.getElementById('payment_method_id').value = defaultPaymentMethod.getAttribute('data-payment-method-id');
            }
    
            // Event listener for payment method selection
            paymentMethods.forEach(function(card) {
                card.addEventListener('click', function() {
                    // Remove 'selected' class from all cards
                    paymentMethods.forEach(function(card) {
                        card.classList.remove('selected');
                    });
    
                    // Add 'selected' class to clicked card
                    card.classList.add('selected');
                    document.getElementById('payment_method_id').value = card.getAttribute('data-payment-method-id');
                });
            });
    
            // Listen for amount changes and calculate admin fee if QRIS is selected
            document.getElementById('amount').addEventListener('input', function() {
                const amountInput = document.getElementById('amount');
                let amount = parseFloat(amountInput.value);
                const paymentMethodId = document.getElementById('payment_method_id').value;
                const selectedPaymentMethod = document.querySelector(`#payment-method-${paymentMethodId}`);
    
                if (selectedPaymentMethod && selectedPaymentMethod.getAttribute('data-method-code') === 'qris') {
                    // Calculate the admin fee (0.7%)
                    if (amount && !isNaN(amount)) {
                        const adminFee = amount * 0.007; // 0.7% admin fee
                        const totalAmount = amount + adminFee;
                        amountInput.value = totalAmount.toFixed(2); // Update amount with admin fee
                    }
                }
            });
        });
    </script>

        <script>
            $(document).ready(function() {
                $('#btn-amount-1').click(function() {
                    $('#amount').val("Rp 10.000");
                    $('#amount-hidden').val(10000);
                });
                $('#btn-amount-2').click(function() {
                    $('#amount').val("Rp 50.000");
                    $('#amount-hidden').val(50000);
                });
                $('#btn-amount-3').click(function() {
                    $('#amount').val("Rp 100.000");
                    $('#amount-hidden').val(100000);
                });
                $('#btn-amount-4').click(function() {
                    $('#amount').val("Rp 300.000");
                    $('#amount-hidden').val(300000);
                });
                $('#btn-amount-5').click(function() {
                    $('#amount').val("Rp 500.000");
                    $('#amount-hidden').val(500000);
                });
                $('#btn-amount-6').click(function() {
                    $('#amount').val("Rp 1.000.000");
                    $('#amount-hidden').val(1000000);
                });
            });
        </script>
        <script>
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix === undefined ? rupiah : rupiah ? 'Rp ' + rupiah : '';
            }

            $(document).ready(function() {
                $('#amount').on('input', function() {
                    var amount = $(this).val();
                    var formattedAmount = formatRupiah(amount, 'Rp ');
                    $(this).val(formattedAmount);
                });

                $('#amount').on('change', function() {
                    var amount = $(this).val();
                    var unformattedAmount = amount.replace(/[^0-9]/g, '');
                    $('#amount-hidden').val(unformattedAmount);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.payment-method-card').click(function() {
                    // Remove 'active' class from all cards
                    $('.payment-method-card').removeClass('active');

                    // Get the payment method ID from the clicked card
                    var paymentMethodId = $(this).data('payment-method-id');

                    // Set the payment method ID to the hidden input field
                    $('#payment_method_id').val(paymentMethodId);

                    // Add 'active' class to the clicked card
                    $(this).addClass('active');
                });
            });
        </script>
        <script>
            $(document).ready(function() {

                $('#message').on('input', function() {
                    var maxLength = 120;
                    var currentMessage = $(this).val();

                    if (currentMessage.length > maxLength) {
                        var trimmedMessage = currentMessage.substring(0, maxLength);
                        $(this).val(trimmedMessage);
                    }

                    var totalMessage = $(this).val().length;
                    $('#totalMessage').text(totalMessage);

                    if (totalMessage >= maxLength) {
                        $(this).on('keydown', function(e) {
                            // Allow deleting characters with the Backspace key
                            if (e.key !== 'Backspace') {
                                e.preventDefault();
                            }
                        });
                    } else {
                        // Remove the keydown event if the character count is below the limit
                        $(this).off('keydown');
                    }
                });



            });
        </script>
    @endpush

</x-layouts.frontend>
