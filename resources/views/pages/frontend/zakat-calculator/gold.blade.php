<x-layouts.frontend title="Hitung Zakat Emas Mu Disini" description="Kalkulator Zakat Emas Lazismu"
    thumbnail="{{ asset('frontend/assets/images/calculator/emas.jpeg') }}">
    <x-frontend.header-section subheading="Hitung Zakat Mu Disini" heading="Kalkulator Zakat Emas"
        supporting-text="Kalkulator Zakat Lazismu adalah aplikasi yang dapat membantu anda menghitung zakat anda secara online." />
    <div class="container mt-3">
        <x-frontend.nav-calculator active="emas" />

        <form id="form-tabungan">
            <x-input.text type="text" name="jumlah_emas" label="Jumlah Emas (gram)"
                placeholder="Masukkan Total Berat Emas Yang Anda Miliki" required id="jumlah_emas" />
            <x-input.text type="text" name="kewajiban_bayar" label="Kewajiban Bayar" id="kewajiban_bayar" readonly />
            <x-button.primary class="btn btn-primary mb-3 d-none" id="btn-zakat">
                Zakat Sekarang
            </x-button.primary>
            <x-button.primary class="btn btn-primary mb-3 d-none" id="btn-infak"
                onclick="window.location.href='{{ route('campaign.index') }}'">
                Infak Sekarang
            </x-button.primary>
            <p>Note:</p>
            <p>
                - Perhitungan zakat diupdate otomatis berdasarkan update harga emas 24 karat
            </p>
            <p>
                Harga emas per gram saat ini adalah <span id="harga-emas"></span>
            </p>
            <p>
                - Nishab 85 gram per tahun
                (<span id="nishab-sekarang"></span>)
            </p>

        </form>
    </div>

    @push('custom-scripts')
        <script>
            function formatRupiah(angka, prefix) {
                // Convert angka to string if it's a number
                var number_string = typeof angka === 'number' ? angka.toString() : angka;

                // Remove non-digit and non-dot characters
                number_string = number_string.replace(/[^.\d]/g, '');

                var split = number_string.split('.'),
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
        </script>
        <script>
            async function getNishab() {
                try {
                    const response = await fetch('https://pluang.com/api/asset/gold/pricing?daysLimit=0');
                    const data = await response.json();
                    var price = data.data.current.midPrice;
                    nishab = (price * 85);


                    if (nishab % 1 !== 0) {
                        nishab = Math.round(nishab);
                    }


                    document.getElementById('nishab-sekarang').innerHTML = formatRupiah(nishab.toString(), 'Rp ');
                    document.getElementById('harga-emas').innerHTML = formatRupiah(price.toString(), 'Rp ');
                } catch (error) {
                    console.error('Error fetching nishab:', error);
                }
            }

            getNishab();

            $(document).ready(function() {
                $('#jumlah_emas').on('input', function() {
                    calculateZakat();
                });
            });

            function calculateZakat() {
                var jumlah_emas = $('#jumlah_emas').val();

                if (jumlah_emas >= 85) {
                    var price_gold = $('#harga-emas').text().replace('Rp ', '').replace('.', '').replace('.', '');
                    var kewajiban_bayar = jumlah_emas * price_gold * 0.025;
                    console.log(kewajiban_bayar);
                    kewajiban_bayar = formatRupiah(kewajiban_bayar);

                    $('#kewajiban_bayar').val(kewajiban_bayar);
                    $('#kewajiban_bayar').css('color', 'green');
                    $('#kewajiban_bayar').css('font-weight', 'bold');
                    $('#btn-zakat').removeClass('d-none');
                    $('#btn-infak').addClass('d-none');
                } else {
                    $('#kewajiban_bayar').val("Anda Belum Wajib Membayar Zakat");
                    $('#kewajiban_bayar').css('color', 'red');
                    $('#kewajiban_bayar').css('font-weight', 'bold');
                    $('#btn-zakat').addClass('d-none');
                    $('#btn-infak').removeClass('d-none');
                }
            }
        </script>
        <script>
            $('#btn-zakat').click(function() {
                var kewajiban_bayar = parseInt($('#kewajiban_bayar').val().replace(/[^\d]/g, '')) || 0;

                var zakat = {
                    category_zakat: 'maal',
                    amount: kewajiban_bayar,
                }

                localStorage.setItem('zakat', JSON.stringify(zakat));

                window.location.href = "{{ route('zakat-maal.paymentMethod') }}";
            });
        </script>
    @endpush
</x-layouts.frontend>
