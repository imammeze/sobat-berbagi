<x-layouts.admin>

    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Website</a></li>
                <li class="breadcrumb-item">Banner</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Banner">
                <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <img src="{{ $banner->desktop_image }}" alt="desktop" class="mb-2" width="400"
                        id="desktop_image_preview">
                    <x-input.file label="Desktop Image" name="desktop_image" />
                    <img src="{{ $banner->mobile_image }}" alt="desktop" class="mb-2" width="400"
                        id="mobile_image_preview">
                    <x-input.file label="Mobile Image" name="mobile_image" />
                    <x-input.text label="Link" name="link" type="text" placeholder="Link"
                        value="{{ $banner->link }}" />
                    <x-button.primary class="float-end" type="submit">
                        Update
                    </x-button.primary>
                </form>
            </x-admin.card>
        </div>
    </div>



    @push('custom-scripts')
        <script>
            // preview image
            function previewImage(input, element) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(element).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // preview desktop image
            $("#desktop_image").change(function() {
                previewImage(this, '#desktop_image_preview');
            });

            // preview mobile image
            $("#mobile_image").change(function() {
                previewImage(this, '#mobile_image_preview');
            });
        </script>
    @endpush
</x-layouts.admin>
