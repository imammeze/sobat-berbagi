<x-layouts.admin>
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/css/lightbox.css') }}">
    @endpush

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Transaksi</a></li>
                <li class="breadcrumb-item">Transaksi Zakat</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Transaksi">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th>Donatur</th>
                                <td>{{ $transaction->user->donaturRelation->name }}</td>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <td>{{ $transaction->paymentMethod->name }} -
                                    {{ $transaction->paymentMethod->number }}</td>
                            </tr>
                            <tr>
                                <th>Total Donasi</th>
                                <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Kategori Zakat</th>
                                <td>{{ $transaction->category_zakat }}</td>
                            </tr>
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td>
                                    <a href="{{ asset($transaction->proof ?? '') }}" data-lightbox="image-1"
                                        data-title="Bukti Pembayaran {{ $transaction->paymentMethod->name }}">
                                        <img src="{{ asset($transaction->proof ?? '') }}" alt="Bukti Pembayaran"
                                            class="img-table-lightbox" width="100">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($transaction->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($transaction->status == 'success')
                                        <span class="badge bg-success">Success</span>
                                    @elseif ($transaction->status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <x-slot name="footer">
                            @if ($transaction->status == 'pending')
                                <div class="d-flex justify-content-between">
                                    <form action="{{ route('admin.transaksi-zakat.update', $transaction->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name" value="{{ $transaction->user->donaturRelation->name }}">
                                        <input type="hidden" name="phone_number"
                                        value="{{ $transaction->user->donaturRelation->phone_number }}">
                                        <input type="hidden" name="status" value="success">

                                        <button class="btn btn-success btn-sm"
                                            onclick="return confirm('Apakah anda yakin ingin menerima transaksi ini?')">
                                            Terima</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('admin.transaksi-zakat.index') }}"
                                    class="btn btn-danger btn-sm">Kembali</a>
                            @endif
                        </x-slot>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>

    @push('plugin-scripts')
        <script src="{{ asset('admin/assets/plugins/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>

        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>
    @endpush
</x-layouts.admin>
