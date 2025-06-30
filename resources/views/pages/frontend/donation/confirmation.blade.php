<x-layouts.frontend title="Donasi {{ $campaign->title }}">
    @push('styles')
        <style>
            .guest-form input {
                padding: 10px 14px;
                border-radius: 8px;
                border: 1px solid var(--Gray-300, #B3B9C6);
                background: var(--White, #FFF);
                box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);
            }

            textarea {
                padding: 10px 14px;
                border-radius: 8px;
                border: 1px solid var(--Gray-300, #B3B9C6);
                background: var(--White, #FFF);
                box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);
            }
        </style>
    @endpush

    <x-frontend.header-mobile back-link="{{ route('donation.paymentMethod', $campaign->slug) }}"
        back-link-text="Konfirmasi Pembayaran" />
    <div class="container">

        <h6>Nominal Donasi</h6>
        <h4 class="fw-bold mb-4" id="amount-display"></h4>
        <h6 class="mb-2">Metode Pembayaran</h6>

        <div class="d-flex align-items-center gap-3 py-3">
            <img src="" id="payment-method-logo" width="120">
            <h6 class="fw-bold mb-0" id="payment-method-name"></h6>
        </div>

        @guest
            <div class="py-3 guest-form">
                <p class="text-center mb-0">
                    <a href="{{ route('login', ['redirect' => route('donation.confirmation', $campaign->slug)]) }}"
                        class="text-decoration-none text-primary">
                        Masuk
                    </a>
                    atau lengkapi data dibawah ini
                </p>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <x-form.input id="name" type="text" placeholder="Nama Lengkap" mb="0" name="name"
                    value="{{ old('name') }}" />
                <x-form.input id="email" type="email" placeholder="Email" mb="0" name="email"
                    value="{{ old('email') }}" />
                <x-form.input id="phone_number" type="text" placeholder="Nomor Ponsel" mb="3" name="phone_number"
                    value="{{ old('phone_number') }}" />
            </div>
        @endguest

        <div class="mb-0">
            <label for="messages" class="form-label">Pesan Dukungan (Opsional)</label>
            <textarea class="form-control" id="messages" name="messages" rows="5"
                placeholder="Tulis doa untuk penggalang dana atau dirimu sendiri di sini.">{{ old('message') }}</textarea>
            <div class="form-text">
                <span class="text-muted" id="totalMessage">0</span>/120
            </div>
        </div>

        <div class="mb-3">
            <label for="is_anonymous" class="form-label"></label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_anonymous" id="is_anonymous" value="1">
                <label class="form-check-label" for="is_anonymous">
                    Sembunyikan nama saya (Hamba Allah)
                </label>
            </div>
        </div>



        <form action="{{ route('donation.store', $campaign->slug) }}" method="POST">
            @csrf
            @auth
                <input type="hidden" name="is_guest" value="0">
            @else
                <input type="hidden" name="is_guest" value="1">
                <input type="hidden" name="email" value="{{ old('email') }}">
                <input type="hidden" name="name" value="{{ old('name') }}">
                <input type="hidden" name="phone_number" value="{{ old('phone_number') }}">
            @endauth
            <input type="hidden" name="amount" value="">
            <input type="hidden" name="payment_method_id" value="">
            <input type="hidden" name="message" value="">
            <input type="hidden" name="is_anonymous" value="0">
            <x-button.primary class="w-100 mt-3 rounded-5" type="submit">
                Konfirmasi Pembayaran
            </x-button.primary>
        </form>
    </div>

    @if (session('login_success'))
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                if (!sessionStorage.getItem('reloaded')) {
                    sessionStorage.setItem('reloaded', 'true');
                    window.location.reload();
                } else {
                    sessionStorage.removeItem('reloaded');
                }
            });
        </script>
    @endif


    @push('custom-scripts')
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

            var donation = JSON.parse(localStorage.getItem('donation'));

            var amount = donation.amount;
            var paymentMethodLogo = donation.payment_method_logo;
            var paymentMethodName = donation.payment_method_name;


            $('#amount-display').html(formatRupiah(amount.toString(), 'Rp. '));
            $('#payment-method-logo').attr('src', paymentMethodLogo);
            $('#payment-method-name').html(paymentMethodName);

            $('input[name="amount"]').val(donation.amount);
            $('input[name="payment_method_id"]').val(donation.payment_method_id);
        </script>

        <script>
            $(document).ready(function() {

                $('#messages').on('input', function() {
                    $('input[name="message"]').val($(this).val());
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




                $('#is_anonymous').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('input[name="is_anonymous"]').val(1);
                    } else {
                        $('input[name="is_anonymous"]').val(0);
                    }
                });
            });
        </script>
    @endpush

    @guest
        @push('custom-scripts')
            <script>
                $(document).ready(function() {
                    $('#email').on('input', function() {
                        $('input[name="email"]').val($(this).val());
                    });

                    $('#name').on('input', function() {
                        $('input[name="name"]').val($(this).val());
                    });

                    $('#phone_number').on('input', function() {
                        $('input[name="phone_number"]').val($(this).val());
                    });

                });
            </script>
        @endpush
    @endguest

</x-layouts.frontend>
