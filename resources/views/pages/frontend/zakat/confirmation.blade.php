<x-layouts.frontend title="Zakat Maal">

    @if (request()->segment(1) == 'zakat-maal')
        <x-frontend.header-mobile back-link="{{ route('zakat-maal.paymentMethod') }}"
            back-link-text="Pilih Metode Pembayaran" />
    @elseif (request()->segment(1) == 'zakat-fitrah')
        <x-frontend.header-mobile back-link="{{ route('zakat-fitrah.paymentMethod') }}"
            back-link-text="Pilih Metode Pembayaran" />
    @endif

    <div class="container">

        <h6>Nominal Donasi</h6>
        <h4 class="fw-bold mb-4" id="amount-display"></h4>
        <h6 class="mb-2">Metode Pembayaran</h6>
        <div class="d-flex align-items-center gap-3 mb-3">
            <img src="" id="payment-method-logo" width="120">
            <h6 class="fw-bold mb-0" id="payment-method-name"></h6>
        </div>
        @guest
            <p class="text-center mb-3">
                <a href="{{ route('login', ['redirect' => route('zakat-maal.confirmation')]) }}">
                    Masuk
                </a>
                atau lengkapi data diri anda untuk melanjutkan
            </p>
            <x-input.email id="email" value="{{ old('email') }}" />
            <x-input.text label="Nama Lengkap" id="name" value="{{ old('name') }}" />
            <x-input.text label="Nomer Hp Aktif" id="phone_number" value="{{ old('phone_number') }}" />
            <x-input.text label="Alamat" id="address" value="{{ old('address') }}" />
        @endguest
        <x-input.checkbox label="Donasi Sebagai Anonim" id="anonim" name="is_anonymous" value="1" />


        @php
            $categoryZakat = request()->segment(1);
        @endphp

        <form  action="{{ route($categoryZakat . '.store') }}" method="POST">
            @csrf

            @auth
                <input type="hidden" name="is_guest" value="0">
            @else
                <input type="hidden" name="is_guest" value="1">
                <input type="hidden" name="email" value="">
                <input type="hidden" name="name" value="">
                <input type="hidden" name="phone_number" value="">
                <input type="hidden" name="address" value="">
            @endauth
            <input type="hidden" name="amount" value="">
            <input type="hidden" name="payment_method_id" value="">
            <input type="hidden" name="message" value="">
            <input type="hidden" name="is_anonymous" value="">
            <input type="hidden" name="category_zakat" value="">
            <x-button.primary class="w-100 mt-3" type="submit">
                Zakat Sekarang
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

            var zakat = JSON.parse(localStorage.getItem('zakat'));

            var amount = parseInt(zakat.amount);
            var paymentMethodLogo = zakat.payment_method_logo;
            var paymentMethodName = zakat.payment_method_name;


            $('#amount-display').html(formatRupiah(amount.toString(), 'Rp. '));
            $('#payment-method-logo').attr('src', paymentMethodLogo);
            $('#payment-method-name').html(paymentMethodName);

            $('input[name="amount"]').val(zakat.amount);
            $('input[name="payment_method_id"]').val(zakat.payment_method_id);
            $('input[name="is_anonymous"]').val(zakat.is_anonymous);
            $('input[name="category_zakat"]').val(zakat.category_zakat);
        </script>
    @endpush

    @guest
        @push('custom-scripts')
            @if(session('login_success'))
                <script>
                    location.reload();
                    // Cek apakah user baru saja login
                    if (sessionStorage.getItem('reloadAfterLogin')) {
                        sessionStorage.removeItem('reloadAfterLogin'); // Hapus flag setelah reload
                        location.reload(); // Refresh halaman setelah login
                    }

                    sessionStorage.setItem('reloadAfterLogin', true);
                </script>    
                <script>
                    if (performance.navigation.type === 1) {
                        // Jika sudah reload, jangan reload lagi
                    } else {
                        location.reload();
                    }
                </script>
            @endif
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

                    $('#address').on('input', function() {
                        $('input[name="address"]').val($(this).val());
                    });

                    $('#anonim').on('change', function() {
                        if ($(this).is(':checked')) {
                            $('input[name="is_anonymous"]').val("on");
                        } else {
                            $('input[name="is_anonymous"]').val();
                        }
                    });
                });
            </script>
        @endpush
    @endguest

</x-layouts.frontend>
