<x-layouts.admin>
    @push('style')
        <style>
            .table td img {
                width: 100px !important;
                height: 100px !important;
                object-fit: cover;
                object-position: center;
            }
        </style>
    @endpush
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Website</a></li>
                <li class="breadcrumb-item active" aria-current="page">Team</li>
            </ol>
        </nav>

        @can('team-create')
            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah Team</a>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Team">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Posisi</th>

                            @canany(['team-edit', 'team-delete'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($teams as $team)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $team->image }}" alt="{{ $team->name }}">
                                </td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->position }}</td>
                                <td>

                                    @can('team-edit')
                                        <a href="{{ route('admin.teams.edit', $team->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    @endcan

                                    @can('team-delete')
                                        <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
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
