<x-layouts.frontend title="Hitung Zakat Tabungan Mu Disini" description="Kalkulator Zakat Tabungan Lazismu"
    thumbnail="{{ asset('frontend/assets/images/calculator/tabungan.jpeg') }}">
    <x-frontend.header-section subheading="Hitung Zakat Mu Disini" heading="Kalkulator Zakat Tabungan"
        supporting-text="Kalkulator Zakat Lazismu adalah aplikasi yang dapat membantu anda menghitung zakat anda secara online." />
    <div class="container mt-3">
        <x-frontend.nav-calculator active="tabungan" />

        <form id="form-tabungan">
            <x-input.text type="text" name="saldo" label="Saldo Tabungan"
                placeholder="Masukkan Jumlah Saldo Tabungan Anda" required id="saldo" />
            <x-input.text type="text" name="bunga" label="Bunga (Jika menabung di bank konvesional)"
                placeholder="Masukkan Bunga" id="bunga" value="0" />
            <x-input.text type="text" name="share" label="Bagi Hasil (Jika menabung di bank syariah)"
                placeholder="Masukkan Bagi Hasil" id="share" value="0" />
            <x-input.text type="text" name="total" label="Total Tabungan" id="total" readonly />
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
                - Nishab 85 gram per bulan
                (<span id="nishab-sekarang"></span>)
            </p>

        </form>
    </div>

    @push('custom-scripts')
        <script>
            fetch('https://pluang.com/api/asset/gold/pricing?daysLimit=0')
                .then(response => response.json())
                .then(data => {
                    var price = data.data.current.midPrice;
                    var nishab = (price * 85) / 12;

                    if (nishab % 1 !== 0) {
                        nishab = Math.round(nishab);
                    }

                    document.getElementById('nishab-sekarang').innerHTML = formatRupiah(nishab.toString(), 'Rp ');
                    document.getElementById('harga-emas').innerHTML = formatRupiah(price.toString(), 'Rp ');

                });
        </script>
        <script src="{{ asset('frontend/js/zakat-calculator/tabungan.js') }}"></script>
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
