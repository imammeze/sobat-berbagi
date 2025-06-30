<x-layouts.frontend title="Hitung Zakat Pertanian Mu Disini" description="Kalkulator Zakat Pertanian Lazismu"
    thumbnail="{{ asset('frontend/assets/images/calculator/pertanian.jpeg') }}">
    <x-frontend.header-section subheading="Hitung Zakat Mu Disini" heading="Kalkulator Zakat Pertanian"
        supporting-text="Kalkulator Zakat Lazismu adalah aplikasi yang dapat membantu anda menghitung zakat anda secara online." />
    <div class="container mt-3">
        <x-frontend.nav-calculator active="pertanian" />

        <form id="form-tabungan">
            <div class="mb-3">
                <label for="nama" class="form-label">
                    Jenis Pengairan
                </label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis" checked value="hujan">
                        <label class="form-check-label" for="jenis">
                            Di Aliri Air Hujan, Sungai, Mata Air
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis" value="buatan">
                        <label class="form-check-label" for="jenis">
                            Di Aliri Irigasi / Mesin
                        </label>
                    </div>
                </div>
            </div>
            <x-input.text type="text" name="hasil" label="Total Pendapatan Hasil Panen"
                placeholder="Masukkan Total Pendapatan Hasil Panen" id="hasil" />
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
                - Nishab Zakat Pertanian adalah 5 Wasaq (653 Kg) gabah
            </p>
            <p>
                - Perhitungan zakat diupdate otomatis berdasarkan update harga gabah per kg
            </p>
            <p>
                - Harga gabah per kg saat ini adalah Rp {{ number_format(env('GABAH_PRICE'), 0, ',', '.') }}
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

            var nishab = {{ env('GABAH_PRICE') }} * 653;

            $(document).ready(function() {
                jenis = 'jasa';
                persen = 0.1;
                $('input[name="jenis"]').on('change', function() {
                    if ($(this).val() == 'jasa') {
                        jenis = 'hujan';
                        persen = 0.1;
                    } else {
                        jenis = 'buatan';
                        persen = 0.05;
                        $('#hasil').val('');
                        $('#kewajiban_bayar').val('');
                    }
                });

                $('#hasil').on('input', function() {
                    var hasil = parseInt($('#hasil').val().replace(/[^\d]/g, '')) || 0;

                    $('#hasil').val(formatRupiah(hasil.toString(), 'Rp '));

                    var total = hasil;

                    var kewajiban_bayar = total * persen;
                    $('#kewajiban_bayar').val(formatRupiah(kewajiban_bayar.toString(), 'Rp '));

                    if (total >= nishab) {
                        $('#btn-zakat').removeClass('d-none');
                        $('#btn-infak').addClass('d-none');
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
