@extends('layouts.auth.index')

@section('content')
    
<form class="form w-100" action="{{ route('password.update', ['token' => $token]) }}" method="POST">
    @csrf
    <!--begin::Heading-->
    <div class="mb-10 text-center">
        <!--begin::Title-->
        <h1 class="mb-3 text-dark fw-bolder">Buat Password Baru</h1>
        <!--end::Title-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group=-->
    <div class="mb-8 fv-row">
        <!--begin::Repeat Password-->
        <label for="username">Username</label>
        <input type="text" name="username" autocomplete="off" class="bg-transparent form-control" id="username" required/>
        <!--end::Repeat Password-->
    </div>
    <!--end::Input group=-->
    <!--begin::Input group-->
    <div class="mb-8 fv-row" data-kt-password-meter="true">
        <!--begin::Wrapper-->
        <div class="mb-1">
            <!--begin::Input wrapper-->
            <label for="password">Password</label>
            <div class="mb-3 position-relative">
                <input class="bg-transparent form-control" type="password" name="password" autocomplete="off" id="password" required/>
                <span class="top-50 btn btn-sm btn-icon position-absolute translate-middle end-0 me-n2" id="togglePassword">
                    <i class="bi bi-eye-slash fs-2" id="toggleIconPassword"></i>
                </span>
            </div>
            <!--end::Input wrapper-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Hint-->
        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
        <!--end::Hint-->
    </div>
    <!--end::Input group=-->
    <!--begin::Input group=-->
    <div class="mb-8 fv-row">
        <!--begin::Repeat Password-->
        <label for="password_confirmation">Konfirmasi Password</label>
        <div class="mb-3 position-relative">
            <input type="password" name="password_confirmation" autocomplete="off" class="bg-transparent form-control" id="password_confirmation" required/>
            <span class="top-50 btn btn-sm btn-icon position-absolute translate-middle end-0 me-n2" id="togglePasswordConfirmation">
                <i class="bi bi-eye-slash fs-2" id="toggleIconConfirmation"></i>
            </span>
        </div>
        <!--end::Repeat Password-->
    </div>
    <!--end::Input group=-->
    <!--begin::Action-->
    <div class="mb-10">
        <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
            <!--begin::Indicator label-->
            <span class="indicator-label">Reset Password</span>
            <!--end::Indicator label-->
        </button>
    </div>
    <!--end::Action-->
</form>

<script>
    // JavaScript untuk fitur Tampilkan Password
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    const toggleIconPassword = document.querySelector('#toggleIconPassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        toggleIconPassword.classList.toggle('bi-eye');
        toggleIconPassword.classList.toggle('bi-eye-slash');
    });

    // JavaScript untuk fitur Tampilkan Password Confirmation
    const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
    const confirmPasswordField = document.querySelector('#password_confirmation');
    const toggleIconConfirmation = document.querySelector('#toggleIconConfirmation');

    togglePasswordConfirmation.addEventListener('click', function () {
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);
        toggleIconConfirmation.classList.toggle('bi-eye');
        toggleIconConfirmation.classList.toggle('bi-eye-slash');
    });
</script>

@endsection
