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

async function getNishab() {
    try {
        const response = await fetch('https://pluang.com/api/asset/gold/pricing?daysLimit=0');
        const data = await response.json();
        var price = data.data.current.midPrice;
        nishab = (price * 85);

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
    $('#saldo, #bunga, #share').on('input', function () {
        calculateZakat();
    });
});

function calculateZakat() {
    var saldo = $('#saldo').val().replace(/[^\d]/g, '');
    var bunga = $('#bunga').val().replace(/[^\d]/g, '') || 0;
    var share = $('#share').val().replace(/[^\d]/g, '') || 0;

    $('#saldo').val(formatRupiah(saldo.toString(), 'Rp '));
    $('#bunga').val(formatRupiah(bunga.toString(), 'Rp '));
    $('#share').val(formatRupiah(share.toString(), 'Rp '));

    var total = parseInt(saldo) - parseInt(bunga) + parseInt(share);
    $('#total').val(formatRupiah(total.toString(), 'Rp '));


    if (total >= nishab) {
        var kewajiban_bayar = total * 0.025;
        $('#kewajiban_bayar').val(formatRupiah(kewajiban_bayar.toString(), 'Rp '));
        $('#kewajiban_bayar').css('color', 'green');
        $('#btn-zakat').removeClass('d-none');
        $('#btn-infak').addClass('d-none');
    } else {
        $('#kewajiban_bayar').val("Anda Tidak Wajib Membayar Zakat");
        $('#kewajiban_bayar').css('color', 'red');
        $('#btn-zakat').addClass('d-none');
        $('#btn-infak').removeClass('d-none');
    }
}
