<x-layouts.admin>
    @push('plugin-styles')
        <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    @endpush

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Manajemen User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Role</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Role">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Hak Akses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        {{ $role->permissions->count() }} Hak Akses
                                    </td>
                                    <td>
                                        @can('role-edit')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.card>
        </div>
    </div>

    @push('plugin-scripts')
        <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    @endpush

    @push('custom-scripts')
        <script src="{{ asset('assets/js/data-table.js') }}"></script>
    @endpush
</x-layouts.admin>
