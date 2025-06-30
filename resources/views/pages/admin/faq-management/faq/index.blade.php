<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Faq</a></li>
                <li class="breadcrumb-item active" aria-current="page">Faq</li>
            </ol>
        </nav>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah
            FAQ</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Faq">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>pertanyaan</th>
                            <th>Jawaban</th>

                            @canany(['faq-edit', 'faq-delete'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $faq->category->name }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($faq->answer, 50) }}</td>
                                <td>
                                    @can('faq-edit')
                                        <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    @endcan

                                    @can('faq-delete')
                                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
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
