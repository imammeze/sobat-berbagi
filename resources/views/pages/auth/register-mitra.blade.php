<x-layouts.auth title="Buat Akun">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-12 col-md-12 col-xl-8 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-12 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2 text-center">Daftar Jadi Mitra</a>
                                <h5 class="text-muted fw-normal mb-4 text-center">Registrasi Sesuai Dengan Data</h5>
                                <form action="{{ route('register-mitra.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <x-form.input type="email" name="email" value="{{ old('email') }}"
                                        label="Email" />
                                    <x-input.text name="name" value="{{ old('name') }}" label="Nama Mitra" />
                                    <x-input.text name="slug" value="{{ old('slug') }}" label="Username" />
                                    <x-form.input type="file" name="logo" label="Logo Mitra" />
                                    <x-input.textarea name="description" value="{{ old('description') }}"
                                        label="Deskripsi Mitra" />
                                    <x-input.textarea name="address" value="{{ old('address') }}"
                                        label="Alamat Mitra" />
                                    <x-input.text name="phone" value="{{ old('phone') }}" label="Nomer Hp Aktif" />
                                    <x-input.text name="identity_number" value="{{ old('identity_number') }}"
                                        label="NIK" />
                                    <x-form.input name="pic_name" value="{{ old('pic_name') }}"
                                        label="Nama Penanggung Jawab" />
                                    <x-form.input type="file" name="identity_file" label="Foto KTP" />
                                    <x-form.input type="file" name="identity_file_handheld"
                                        label="Foto Selfie bersama KTP" accept="image/*" capture="camera" />
                                    <x-input.password name="password" value="" label="Password" />

                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Daftar
                                    </x-button.primary>

                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <hr class="w-25 me-2">
                                        <span class="fw-bold text-muted">Atau</span>
                                        <hr class="w-25 ms-2">
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                            Daftar Donatur
                                        </a>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-6 mb-0 fw-bold">Sudah Punya Akun?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">
                                            Login
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
