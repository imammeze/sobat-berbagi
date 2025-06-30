<x-layouts.frontend title="Hitung Zakat Perusahaan Mu Disini" description="Kalkulator Zakat Perusahaan Lazismu"
    thumbnail="{{ asset('frontend/assets/images/calculator/perusahaan.jpeg') }}">
    <x-frontend.header-section subheading="Hitung Zakat Mu Disini" heading="Kalkulator Zakat Perusahaan"
        supporting-text="Kalkulator Zakat Lazismu adalah aplikasi yang dapat membantu anda menghitung zakat anda secara online." />
    <div class="container mt-3">
        <x-frontend.nav-calculator active="perusahaan" />

        <form id="form-tabungan">
            <div class="mb-3">
                <label for="nama" class="form-label">Jenis Perusahaan</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis" checked value="jasa">
                        <label class="form-check-label" for="jenis">
                            Perusahaan Jasa
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis" value="dagang">
                        <label class="form-check-label" for="jenis">
                            Perusahaan Dagang / Industri
                        </label>
                    </div>
                </div>
            </div>
            <x-input.text type="text" name="laba" label="Laba Sebelum Pajak 1 Tahun"
                placeholder="Masukkan Laba Usaha Anda" id="laba" />
            <x-input.text type="text" name="asset" label="Asset" placeholder="Masukkan Nilai Asset Anda"
                id="asset" />
            <x-input.text type="text" name="laba_dagang" label="Laba" placeholder="Masukkan Nilai Laba Anda"
                id="laba_dagang" />
            <x-input.text type="text" name="piutang" label="Piutang" placeholder="Masukkan Nilai Piutang"
                id="piutang" />
            <x-input.text type="text" name="hutang" label="Hutang" placeholder="Masukkan Nilai Hutang"
                id="hutang" />
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

            var nishab = 0;
            var hitungper;

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
                jenis = 'jasa';
                $('#asset').parent().hide();
                $('#piutang').parent().hide();
                $('#hutang').parent().hide();
                $('#laba_dagang').parent().hide();
                $('#total').parent().hide();
                $('input[name="jenis"]').on('change', function() {
                    if ($(this).val() == 'jasa') {
                        jenis = 'jasa';
                        $('#laba').parent().show();
                        $('#asset').parent().hide();
                        $('#piutang').parent().hide();
                        $('#hutang').parent().hide();
                        $('#laba_dagang').parent().hide();
                        $('#total').parent().hide();
                    } else {
                        jenis = 'dagang';
                        $('#laba').parent().hide();
                        $('#asset').parent().show();
                        $('#piutang').parent().show();
                        $('#hutang').parent().show();
                        $('#laba_dagang').parent().show();
                        $('#total').parent().show();
                    }
                });

                if (jenis == 'jasa') {
                    $('#laba').on('input', function() {
                        var laba = parseInt($('#laba').val().replace(/[^\d]/g, '')) || 0;
                        $('#laba').val(formatRupiah(laba.toString(), 'Rp '));

                        var kewajiban_bayar = laba * 0.025;

                        if (laba >= nishab) {
                            $('#btn-zakat').removeClass('d-none');
                            $('#btn-infak').addClass('d-none');
                            $('#kewajiban_bayar').val(formatRupiah(kewajiban_bayar.toString(), 'Rp '));
                            $('#kewajiban_bayar').css('color', 'green');
                            $('#kewajiban_bayar').css('font-weight', 'bold');
                        } else {
                            kewajiban_bayar_zakat = "Anda Belum Wajib Membayar Zakat, Tapi Bisa Berinfak";
                            $('#kewajiban_bayar').css('color', 'red');
                            $('#kewajiban_bayar').css('font-weight', 'bold');
                            $('#btn-zakat').addClass('d-none');
                            $('#btn-infak').removeClass('d-none');
                            $('#kewajiban_bayar').val(kewajiban_bayar_zakat);
                        }
                    });
                }



                $('#asset, #piutang, #hutang, #laba_dagang').on('input', function() {
                    var asset = parseInt($('#asset').val().replace(/[^\d]/g, '')) || 0;
                    var piutang = parseInt($('#piutang').val().replace(/[^\d]/g, '')) || 0;
                    var hutang = parseInt($('#hutang').val().replace(/[^\d]/g, '')) || 0;
                    var laba_dagang = parseInt($('#laba_dagang').val().replace(/[^\d]/g, '')) || 0;

                    $('#asset').val(formatRupiah(asset.toString(), 'Rp '));
                    $('#piutang').val(formatRupiah(piutang.toString(), 'Rp '));
                    $('#hutang').val(formatRupiah(hutang.toString(), 'Rp '));
                    $('#laba_dagang').val(formatRupiah(laba_dagang.toString(), 'Rp '));


                    var total = asset + piutang + laba_dagang - hutang;
                    $('#total').val(formatRupiah(total.toString(), 'Rp '));

                    var kewajiban_bayar = total * 0.025;

                    if (total >= nishab) {
                        $('#btn-zakat').removeClass('d-none');
                        $('#btn-infak').addClass('d-none');
                        $('#kewajiban_bayar').val(formatRupiah(kewajiban_bayar.toString(), 'Rp '));
                        $('#kewajiban_bayar').css('color', 'green');
                        $('#kewajiban_bayar').css('font-weight', 'bold');
                    } else {
                        kewajiban_bayar_zakat = "Anda Belum Wajib Membayar Zakat, Tapi Bisa Berinfak";
                        $('#kewajiban_bayar').css('color', 'red');
                        $('#kewajiban_bayar').css('font-weight', 'bold');
                        $('#btn-zakat').addClass('d-none');
                        $('#btn-infak').removeClass('d-none');
                        $('#kewajiban_bayar').val(kewajiban_bayar_zakat);
                    }
                });

            });
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
