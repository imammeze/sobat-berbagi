<x-layouts.auth title="Masuk">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-sm-12 col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper"
                                style="background-image: url({{ asset('frontend/assets/images/auth/welcome-authentication.jpg') }});background-position: center;">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Sobat Berbagi</a>
                                <h5 class="text-muted fw-normal mb-4">
                                    Silahan masuk dengan akun yang sudah terdaftar
                                </h5>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    @if (request()->has('redirect'))
                                        <input type="hidden" name="redirect" value="{{ request()->get('redirect') }}">
                                    @endif
                                    <x-input.email name="email" value="" />
                                    <x-input.password name="password" value="" label="Password" />
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <x-input.checkbox id="remember" label="Remember me" />
                                        <a class="text-primary fw-bold" href="{{ route('forgot-password.index') }}">Lupa
                                            Password?</a>
                                    </div>

                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Masuk
                                    </x-button.primary>

                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-6 mb-0 fw-bold">Pengguna Baru?</p>
                                        @if (request()->has('redirect'))
                                            <a href="{{ route('register', ['redirect' => request()->get('redirect')]) }}"
                                                class="text-primary fw-bold ms-1">Daftar
                                                Sekarang</a>
                                        @else
                                            <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Daftar
                                                Sekarang</a>
                                        @endif
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
