<x-layouts.admin>


    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Metode Pembayaran</li>
            </ol>
        </nav>
        <a href="{{ route('admin.metode-pembayaran.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah
            Metode Pembayaran</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Metode Pembayaran">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>Nomor</th>
                            <th>Pemilik</th>
                            <th>Kategori</th>
                            <th class="noExport">Aksi</th>

                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($paymentMethods as $paymentMethod)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $paymentMethod->code }}</td>
                                <td>{{ $paymentMethod->name }}</td>
                                <td>
                                    <img src="{{ $paymentMethod->logo }}" alt="{{ $paymentMethod->name }}">
                                </td>
                                <td>{{ $paymentMethod->number }}</td>
                                <td>{{ $paymentMethod->owner }}</td>
                                <td>{{ $paymentMethod->category }}</td>
                                <td>
                                    <a href="{{ route('admin.metode-pembayaran.edit', $paymentMethod->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.metode-pembayaran.destroy', $paymentMethod->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>



</x-layouts.admin>
