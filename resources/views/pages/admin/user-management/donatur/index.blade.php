<x-layouts.admin title="Data Donatur">
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Donatur</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Donatur">
                <x-admin.datatable :use-buttons="true" :export-file-name="'Data Donatur'">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>NPWZ</th>
                            <th>Nama</th>
                            <th>Nomer Hp</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($donaturs as $donatur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $donatur->email }}</td>
                                <td>{{ $donatur->donaturRelation->npwz }}</td>
                                <td>{{ $donatur->donaturRelation->name }}</td>
                                <td>{{ $donatur->donaturRelation->phone_number }}</td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
