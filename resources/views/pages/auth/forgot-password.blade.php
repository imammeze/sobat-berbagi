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
                                <a href="#" class="noble-ui-logo d-block mb-2">Lupa Password</a>
                                <h5 class="text-muted fw-normal mb-4">Silahkan Isi Dengan Email Yang Kamu Miliki</h5>
                                <form action="{{ route('forgot-password.store') }}" method="POST">
                                    @csrf
                                    <x-input.email name="email" value="" />
                                    <x-button.primary class="w-100 mb-3" type="submit">
                                        Lupa Password
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
