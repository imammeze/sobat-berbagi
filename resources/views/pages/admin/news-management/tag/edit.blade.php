<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Berita</a></li>
                <li class="breadcrumb-item">Tag</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.news-tags.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Tag Berita">
                <form action="{{ route('admin.news-tags.update', $tag->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input.text label="Nama" name="name" id="name" :value="$tag->name" />
                    <x-input.text label="Slug" name="slug" id="slug" :value="$tag->slug" />
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
