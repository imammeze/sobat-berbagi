<x-layouts.admin title="Mitra">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mitra</li>
            </ol>
        </nav>

        @can('mitra-create')
            <a href="{{ route('admin.mitra.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">
                Tambah Mitra
            </a>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Mitra">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>NIK</th>
                            <th>Nama Mitra</th>
                            <th>Nomer Hp</th>
                            <th>Status</th>
                            <th class="noExport">Aksi</th>

                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($mitras as $mitra)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mitra->email }}</td>
                                <td>{{ $mitra->mitraRelation->identity_number }}</td>
                                <td>{{ $mitra->mitraRelation->name }}</td>
                                <td>{{ $mitra->mitraRelation->phone }}</td>
                                <td>
                                    <span
                                        class="badge
                                    @if ($mitra->mitraRelation->status == 'verified') bg-success
                                    @elseif($mitra->mitraRelation->status == 'rejected')
                                        bg-danger
                                    @else
                                        bg-warning @endif
                                    ">{{ $mitra->mitraRelation->status }}</span>
                                </td>
                                <td>
                                    @can('mitra-edit')
                                        @if ($mitra->mitraRelation->status == 'pending')
                                            <form action="{{ route('admin.mitra.accept') }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id"
                                                    value="{{ $mitra->mitraRelation->id }}">
                                                <button class="btn btn-sm btn-primary"
                                                    onclick="return confirm('Apakah anda yakin ingin memverifikasi?')">Terima
                                                    Mitra</button>
                                            </form>
                                        @endif
                                    @endcan

                                    <a href="{{ route('admin.mitra.show', $mitra->mitraRelation->id) }}"
                                        class="btn btn-sm btn-info">
                                        Detail
                                    </a>

                                    @can('mitra-delete')
                                        <form action="{{ route('admin.mitra.destroy', $mitra->mitraRelation->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus
                                                Mitra</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
