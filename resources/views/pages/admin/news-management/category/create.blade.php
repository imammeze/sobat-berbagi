<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Berita</a></li>
                <li class="breadcrumb-item">Kategori</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>
        </nav>
        <a href="{{ route('admin.news-categories.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Tambah Kategori Berita">
                <form action="{{ route('admin.news-categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input.text label="Nama" name="name" id="name" />
                    <x-input.text label="Slug" name="slug" id="slug" />
                    <x-input.textarea label="Deskripsi" name="description" />
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#name').keyup(function() {
                    $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
                });
            });
        </script>
    @endpush
</x-layouts.admin>
