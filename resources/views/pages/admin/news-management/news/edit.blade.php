<x-layouts.admin>
    @push('plugin-styles')
        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/image-upload/css/image-upload.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <style>
            .ck-editor__editable {
                min-height: 300px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #3b3f5c;
                border-color: #3b3f5c;
                color: #fff;
            }
        </style>
    @endpush



    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Berita</a></li>
                <li class="breadcrumb-item">Berita</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.news.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Berita">
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="input-file">Thumbnail</label>
                        <label for="input-file" id="drop-area" class="drop-area">
                            <input type="file" name="thumbnail" id="input-file" accept="image/*" hidden>
                            <div id="img-view" class="img-view">
                                <img src="{{ asset('admin/assets/plugins/image-upload/images/gallery-export.svg') }}"
                                    id="img" width="50">
                                <p id="img-info">Pilih gambar untuk diunggah</p>
                            </div>
                        </label>
                    </div>
                    <x-input.text name="title" label="Judul" id="title" :value="$news->title" />
                    <x-input.text name="slug" label="Slug" id="slug" :value="$news->slug" />
                    <x-form.mde name="content" label="Konten" id="content" :value="$news->content" />
                    <div class="mb-3">
                        <label class="form-label" for="categories">Kategori</label>
                        <select name="categories[]" id="categories" multiple class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($news->categories->contains($category->id)) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tags">Tag</label>
                        <select name="tags[]" id="tags" multiple class="form-select">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" @if ($news->tags->contains($tag->id)) selected @endif>
                                    {{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-button.primary class="float-end" type="submit">
                        Simpan
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>
    @push('custom-scripts')
        <script src="{{ asset('admin/assets/plugins/image-upload/js/image-upload.js') }}"></script>
        <script>
            new ImageUploader("drop-area", "input-file", "img-view");
        </script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('#tags').select2({
                placeholder: 'Pilih tag',
                allowClear: true
            });

            $('#categories').select2({
                placeholder: 'Pilih kategori',
                allowClear: true
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#title').keyup(function() {
                    $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
                });
            });
        </script>
        <script>
            $('#form').submit(function() {
                $('#content').val(editor.getMarkdown());
            });
        </script>
    @endpush
</x-layouts.admin>
