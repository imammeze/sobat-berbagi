<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi Zakat</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Metode Pembayaran">
                <ul class="nav nav-tabs">
                    @php
                        $paymentMethodCode = request()->input('payment_method_code');
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/transaksi-zakat*') && $paymentMethodCode == 'manual' ? 'active' : '' }}"
                            href="{{ route('admin.transaksi-zakat.index', ['payment_method_code' => 'manual']) }}"
                            aria-current="page">
                            Transaksi Manual
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/transaksi-zakat*') && $paymentMethodCode == 'qris' ? 'active' : '' }}"
                            href="{{ route('admin.transaksi-zakat.index', ['payment_method_code' => 'qris']) }}">
                            Transaksi Qris
                        </a>
                    </li>

                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active">
                        <x-admin.datatable :use-buttons="true" :export-file-name="'Data Transaksi Zakat'">
                            <x-slot name="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Donatur</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Kategori Zakat</th>
                                    <th class="noExport">Aksi</th>
                                </tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->created_at->isoFormat('D MMMM Y HH:mm') }}</td>

                                        <td>{{ $transaction->user->donaturRelation->name }}</td>
                                        <td>{{ $transaction->formatted_amount }}</td>
                                        <td>
                                            @if ($transaction->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($transaction->status == 'success')
                                                <span class="badge bg-success">Success</span>
                                            @elseif ($transaction->status == 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $transaction->category_zakat }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.transaksi-zakat.show', $transaction->id) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                @endforeach
                            </x-slot>
                        </x-admin.datatable>
                    </div>
                </div>

            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
