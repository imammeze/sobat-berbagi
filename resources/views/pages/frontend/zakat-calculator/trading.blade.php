<x-layouts.frontend title="Hitung Zakat Perdagangan Mu Disini" description="Kalkulator Zakat Perdagangan Lazismu"
    thumbnail="{{ asset('frontend/assets/images/calculator/perdagangan.jpeg') }}">
    <x-frontend.header-section subheading="Hitung Zakat Mu Disini" heading="Kalkulator Zakat Perdagangan"
        supporting-text="Kalkulator Zakat Lazismu adalah aplikasi yang dapat membantu anda menghitung zakat anda secara online." />
    <div class="container mt-3">
        <x-frontend.nav-calculator active="perdagangan" />

        <form id="form-tabungan">
            <x-input.text type="text" name="modal" label="Modal Yang Diputar Dalam 1 Tahun"
                placeholder="Masukkan Jumlah Modal Usaha Anda" required id="modal" />
            <x-input.text type="text" name="keuntungan" label="Keuntungan Yang Didapat Dalam 1 Tahun"
                placeholder="Masukkan Jumlah Keuntungan Usaha Anda" required id="keuntungan" />
            <x-input.text type="text" name="piutang_dagang" label="Piutang Dagang Dalam 1 Tahun "
                placeholder="Optional, Jika Ada" id="piutang_dagang" />
            <x-input.text type="text" name="hutang_jatuh_tempo" label="Hutang Jatuh Tempo"
                placeholder="Optional, Jika Ada" id="hutang_jatuh_tempo" />
            <x-input.text type="text" name="kerugian" label="Kerugian Yang Didapat Dalam 1 Tahun"
                placeholder="Optional, Jika Ada" id="kerugian" />
            <x-input.text type="text" name="total" label="Total" id="total" readonly />
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
                $('#modal, #keuntungan , #piutang_dagang, #hutang_jatuh_tempo, #kerugian').on('input',
                    function() {
                        calculateZakat();
                    });
            });

            function calculateZakat() {
                var modal = parseInt($('#modal').val().replace(/[^\d]/g, '')) || 0;
                var keuntungan = parseInt($('#keuntungan').val().replace(/[^\d]/g, '')) || 0;
                var piutang_dagang = parseInt($('#piutang_dagang').val().replace(/[^\d]/g, '')) || 0;
                var hutang_jatuh_tempo = parseInt($('#hutang_jatuh_tempo').val().replace(/[^\d]/g, '')) || 0;
                var kerugian = parseInt($('#kerugian').val().replace(/[^\d]/g, '')) || 0;

                $('#modal').val(formatRupiah(modal.toString(), 'Rp '));
                $('#keuntungan').val(formatRupiah(keuntungan.toString(), 'Rp '));
                $('#piutang_dagang').val(formatRupiah(piutang_dagang.toString(), 'Rp '));
                $('#hutang_jatuh_tempo').val(formatRupiah(hutang_jatuh_tempo.toString(), 'Rp '));
                $('#kerugian').val(formatRupiah(kerugian.toString(), 'Rp '));


                var total = (modal + keuntungan + piutang_dagang) - (hutang_jatuh_tempo + kerugian);
                var kewajiban_bayar = total * 0.025;

                $('#total').val(formatRupiah(total.toString(), 'Rp '));

                if (total >= nishab) {
                    $('#kewajiban_bayar').val(formatRupiah(kewajiban_bayar.toString(), 'Rp '));
                    $('#btn-zakat').removeClass('d-none');
                    $('#btn-infak').removeClass('d-none');
                } else {
                    $('#kewajiban_bayar').val('Tidak Wajib');
                    $('#btn-zakat').addClass('d-none');
                    $('#btn-infak').addClass('d-none');
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
