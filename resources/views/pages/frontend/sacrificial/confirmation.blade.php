<x-layouts.frontend title="Kurban">
    <x-frontend.header-mobile
        back-link-text="Konfirmasi Pembayaran" />
    <div class="container">

        <h6>Nominal</h6>
        <h4 class="fw-bold mb-4" id="amount-display"></h4>
        <h6 class="mb-2">Metode Pembayaran</h6>

        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 ">
                    <img src="" id="payment-method-logo" width="120">
                    <h6 class="fw-bold mb-0" id="payment-method-name"></h6>
                </div>
            </div>
        </div>

        @guest
            <p class="text-center mb-3">
                <a href="{{ route('login', ['redirect' => route('kurban.confirmation', $slug)]) }}">
                    Masuk
                </a>
                atau lengkapi data diri anda untuk melanjutkan
            </p>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <x-form.input id="email" type="email" placeholder="Email" mb="0" name="email"
                value="{{ old('email') }}" />
            <x-form.input id="name" type="text" placeholder="Nama Lengkap" mb="0" name="name"
                value="{{ old('name') }}" />
            <x-form.input id="phone_number" type="text" placeholder="Nomor Telepon" mb="3" name="phone_number"
                value="{{ old('phone_number') }}" />
        @endguest

        @if ($slug === 'kurban-sapi-1-ekor')
            @auth
                <div class="mb-3">
                    <div for="name" class="form-label">Nama Shohibul Qurban 1</div>
                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->donaturRelation->name }}">
                </div>
            @else
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Shohibul Qurban 1</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
            @endauth
            @for ($i = 1; $i < 7; $i++)
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Shohibul Qurban {{ $i + 1 }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
            @endfor
        @endif

        <div class="mb-3">
            <label for="messages" class="form-label">Pesan Dukungan (Opsional)</label>
            <textarea class="form-control" id="messages" name="messages" rows="3">{{ old('message') }}</textarea>
            <div class="form-text">
                <span class="text-muted" id="totalMessage">0</span>/120
            </div>
        </div>


        <form action="{{ route('donation.store', $slug) }}" method="post">
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
            <x-button.primary class="w-100 mt-3" type="submit">
                Kurban Sekarang
            </x-button.primary>
        </form>
    </div>


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

            var sacrifice = JSON.parse(localStorage.getItem('sacrifice'));

            var amount = sacrifice.amount;
            var paymentMethodLogo = sacrifice.payment_method_logo;
            var paymentMethodName = sacrifice.payment_method_name;


            $('#amount-display').html(formatRupiah(amount.toString(), 'Rp. '));
            $('#payment-method-logo').attr('src', paymentMethodLogo);
            $('#payment-method-name').html(paymentMethodName);

            $('input[name="amount"]').val(sacrifice.amount);
            $('input[name="payment_method_id"]').val(sacrifice.payment_method_id);
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
