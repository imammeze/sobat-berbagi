<x-layouts.frontend title="Hitung Zakat Penghasilan Mu Disini" description="Kalkulator Zakat Penghasilan Lazismu"
    thumbnail="{{ asset('frontend/assets/images/zakat/zakat-penghasilan.jpg') }}">
    <x-frontend.header-section subheading="Hitung Zakat Mu Disini" heading="Kalkulator Zakat Lazismu"
        supporting-text="Kalkulator Zakat Lazismu adalah aplikasi yang dapat membantu anda menghitung zakat anda secara online." />
    <div class="container mt-3">
        <x-frontend.nav-calculator active="penghasilan" />
        <form id="form-penghasilan">
            <div class="mb-3">
                <label for="nama" class="form-label">Hitung Per</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hitungper" checked value="bulan">
                        <label class="form-check-label" for="hitungper">
                            Bulan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hitungper" value="tahun">
                        <label class="form-check-label" for="hitungper">
                            Tahun
                        </label>
                    </div>
                </div>
            </div>
            <x-input.text type="text" name="penghasilan" label="Penghasilan" placeholder="Masukkan Penghasilan Anda"
                required id="penghasilan" />
            <x-input.text type="text" name="penghasilan_lain" label="Penghasilan Lain (Bonus, Tunjangan)"
                placeholder="Masukkan Penghasilan Lain Anda (Tunjangan)" id="penghasilan_lain" value="0" />
            <x-input.text type="text" name="kebutuhan_pokok" label="Kebutuhan Pokok (Termasuk Hutang Jatuh Tempo) "
                id="kebutuhan_pokok" required value="0" />
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
        <script src="{{ asset('frontend/js/zakat-calculator/penghasilan.js') }}"></script>
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
