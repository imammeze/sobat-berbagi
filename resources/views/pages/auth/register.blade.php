<x-layouts.auth title="Buat Akun">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-sm-12 col-md-12 col-xl-8 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-5 pe-md-0">
                            <div class="auth-side-wrapper"
                                style="background-image: url({{ asset('frontend/assets/images/auth/welcome-authentication.jpg') }});background-position: center;">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-7 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Sobat Berbagi</a>
                                <h5 class="text-muted fw-normal mb-4">Registrasi Sesuai Dengan Data</h5>
                                <form action="{{ route('register.store') }}" method="POST">
                                    @csrf
                                    @if (request()->has('redirect'))
                                        <input type="hidden" name="redirect" value="{{ request()->get('redirect') }}">
                                    @endif
                                    <x-input.email name="email" value="{{ old('email') }}" />
                                    <x-input.text name="name" value="{{ old('name') }}" label="Nama Lengkap" />
                                    <x-input.text name="phone_number" value="{{ old('phone_number') }}"
                                        label="Nomer Hp Aktif" />
                                    <x-input.password name="password" value="" label="Password" />
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <x-input.checkbox id="remember" label="Remember me" />
                                        <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                                    </div>

                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Daftar
                                    </x-button.primary>

                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <hr class="w-25 me-2">
                                        <span class="fw-bold text-muted">Atau</span>
                                        <hr class="w-25 ms-2">
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                        <a href="{{ route('register-mitra') }}" class="btn btn-outline-primary">
                                            Daftar Mitra
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
