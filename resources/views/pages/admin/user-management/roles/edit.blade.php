<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between">
        <nav class="page-breadcrumb mb-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manajemen Akun</a></li>
                <li class="breadcrumb-item">Role</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>
        </nav>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-danger btn-sm ml-auto mb-3">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-admin.card title="Edit Role">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-input.text label="Nama" name="name" id="name" :value="$role->name" disabled />

                    <div class="mb-3">
                        <label class="form-label me-3" for="permission">Permission</label>
                        <a href="javascript:void(0)" onclick="addAllPermission()">Tambah Semua
                            Permission</a>

                        <select class="js-example-basic-multiple form-control" id="permission" name="permission[]"
                            multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}"
                                    @if ($role->permissions->contains($permission->id)) selected @endif>
                                    {{ $permission->name }}</option>
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
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

            function addAllPermission() {
                var permission = $('#permission option').map(function() {
                    return $(this).val();
                }).get();

                $('#permission').val(permission).trigger('change');
            }
        </script>
    @endpush
</x-layouts.admin>
