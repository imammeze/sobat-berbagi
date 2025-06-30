
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
        nishab = (price * 85) / 12;

        if (nishab % 1 !== 0) {
            nishab = Math.round(nishab);
        }

        calculateZakat();
    } catch (error) {
        console.error('Error fetching nishab:', error);
    }
}

getNishab();

$(document).ready(function () {
    hitungper = 'bulan';
    setPlaceholder('bulan');
    $('input[name="hitungper"]').on('change', function () {
        if ($(this).val() == 'bulan') {
            hitungper = 'bulan';
            setPlaceholder('bulan');
            resetInputValues();
        } else {
            hitungper = 'tahun';
            nishab = nishab * 12;
            setPlaceholder('tahun');
            resetInputValues();
        }
    });

    $('#penghasilan, #penghasilan_lain, #kebutuhan_pokok').on('input', function () {
        calculateZakat();
    });
});

function setPlaceholder(period) {
    $('#penghasilan').attr('placeholder', 'Masukkan Penghasilan Anda Per ' + capitalize(period));
    $('#penghasilan_lain').attr('placeholder', 'Masukkan Penghasilan Lain Anda Per ' + capitalize(period) + ' (Tunjangan) Optional, jika ada');
    $('#kebutuhan_pokok').attr('placeholder', 'Masukkan Kebutuhan Pokok Anda Per ' + capitalize(period) + ' Optional, jika ada');
}

function resetInputValues() {
    $('#penghasilan, #penghasilan_lain, #kebutuhan_pokok').val('');
    $('#kewajiban_bayar').val('');
    $('#btn-zakat').addClass('d-none');
    $('#btn-infak').addClass('d-none');
}

function calculateZakat() {
    var penghasilan = parseInt($('#penghasilan').val().replace(/[^\d]/g, '')) || 0;
    var penghasilan_lain = parseInt($('#penghasilan_lain').val().replace(/[^\d]/g, '')) || 0;
    var kebutuhan_pokok = parseInt($('#kebutuhan_pokok').val().replace(/[^\d]/g, '')) || 0;

    $('#penghasilan').val(formatRupiah(penghasilan.toString(), 'Rp '));
    $('#penghasilan_lain').val(formatRupiah(penghasilan_lain.toString(), 'Rp '));
    $('#kebutuhan_pokok').val(formatRupiah(kebutuhan_pokok.toString(), 'Rp '));

    var kewajiban_bayar = (penghasilan + penghasilan_lain - kebutuhan_pokok) * 0.025;
    var total_penghasilan = penghasilan + penghasilan_lain - kebutuhan_pokok;
    var kewajiban_bayar_zakat;
    console.log(nishab);
    if (total_penghasilan >= nishab) {
        kewajiban_bayar_zakat = formatRupiah(kewajiban_bayar.toString(), 'Rp ');
        $('#kewajiban_bayar').css('color', 'green');
        $('#btn-zakat').removeClass('d-none');
        $('#btn-infak').addClass('d-none');
    } else {
        kewajiban_bayar_zakat = "Anda Belum Wajib Membayar Zakat, Tapi Bisa Berinfak";
        $('#kewajiban_bayar').css('color', 'red');
        $('#btn-zakat').addClass('d-none');
        $('#btn-infak').removeClass('d-none');
    }

    $('#kewajiban_bayar').val(kewajiban_bayar_zakat);
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
    