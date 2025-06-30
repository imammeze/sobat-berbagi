<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">Berita</li>
            </ol>
        </nav>

        @can('article-create')
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm ml-auto mb-3">Tambah
                Berita</a>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Data Berita">
                <x-admin.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Thumbnail</th>
                            <th>Category</th>
                            <th>Tag</th>
                            <th>Status</th>

                            @canany(['article-edit', 'article-delete'])
                                <th class="noExport">Aksi</th>
                            @endcanany
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($news as $news)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $news->title }}</td>
                                <td>{{ $news->slug }}</td>
                                <td>
                                    <img src="{{ asset($news->thumbnail) }}" alt="{{ $news->title }}" class="img-fluid"
                                        width="100">
                                </td>
                                <td>
                                    @foreach ($news->categories as $category)
                                        <span class="badge bg-primary">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($news->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($news->is_published == 1)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-danger">Draft</span>
                                    @endif
                                </td>
                                <td>

                                    @can('article-edit')
                                        <a href="{{ route('admin.news.edit', $news->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    @endcan

                                    @can('article-delete')
                                        <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
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
