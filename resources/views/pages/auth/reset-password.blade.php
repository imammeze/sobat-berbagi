<x-layouts.auth title="Lupa Password">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper"
                                style="background-image: url({{ asset('frontend/assets/images/auth/welcome-authentication.jpg') }});background-position: center;">
                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Reset Password</a>
                                <form action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <x-input.password name="password" value="" label="Password" />
                                    <x-input.password name="password_confirmation" value=""
                                        label="Konfirmasi Password" />
                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Update Password
                                    </x-button.primary>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
