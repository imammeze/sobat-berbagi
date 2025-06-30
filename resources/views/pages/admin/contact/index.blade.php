<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Kontak Form</a></li>
            </ol>
        </nav>

    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Form Kontak">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Perusahaan</th>
                            <th>Nomor Telepon</th>
                            <th>Pesan</th>
                            <th class="noExport">Aksi</th>

                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->company }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->message }}</td>
                                <td>
                                    <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-admin.datatable>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
