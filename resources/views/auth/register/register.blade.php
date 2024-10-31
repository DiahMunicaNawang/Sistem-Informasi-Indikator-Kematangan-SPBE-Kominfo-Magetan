@extends('layouts.auth.index')

@section('content')
    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="form w-100" action="{{ route('register.store') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="mb-3 text-dark fw-bolder">Registrasi</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Silakan isi data berikut untuk mendaftar</div>
            <!--end::Subtitle=-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group=-->
        <div class="mb-8 fv-row">
            <!--begin::Username-->
            <label for="username">Username</label>
            <input type="text" name="username" class="bg-transparent form-control" autocomplete="off" id="username" required>
            <!--end::Username-->
        </div>
        <!--end::Input group=-->

        <div class="mb-8 fv-row">
            <!--begin::Email-->
            <label for="email">Email</label>
            <input type="email" name="email" class="bg-transparent form-control" autocomplete="off" id="email" required>
            <!--end::Email-->
        </div>
        <!--end::Input group=-->

        <div class="mb-3 fv-row">
            <!--begin::Password-->
            <label for="password">Password</label>
            <div class="mb-3 position-relative">
                <input type="password" name="password" class="bg-transparent form-control" autocomplete="off" id="password" required/>
                <span class="top-50 btn btn-sm btn-icon position-absolute translate-middle end-0 me-n2" id="togglePassword">
                    <i class="bi bi-eye-slash fs-2" id="toggleIcon"></i>
                </span>
            </div>
            <!--end::Password-->
        </div>
        <!--end::Input group=-->

        <div class="mb-3 fv-row">
            <!--begin::Confirm Password-->
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="mb-3 position-relative">
                <input type="password" name="password_confirmation" class="bg-transparent form-control" autocomplete="off" id="password_confirmation" required/>
                <span class="top-50 btn btn-sm btn-icon position-absolute translate-middle end-0 me-n2" id="toggleConfirmPassword">
                    <i class="bi bi-eye-slash fs-2" id="toggleConfirmIcon"></i>
                </span>
            </div>
            <!--end::Confirm Password-->
        </div>
        <!--end::Input group=-->

        <!--begin::Submit button-->
        <div class="mb-10 d-grid">
            <button type="submit" class="btn btn-primary">
                Daftar
            </button>
            <br>
            <a href="{{ route('login') }}" class="link-primary text-center">Sudah punya akun? Masuk</a>
        </div>
        <!--end::Submit button-->
    </form>

    <!--begin::Show Password-->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });

        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPasswordField = document.querySelector('#password_confirmation');
        const toggleConfirmIcon = document.querySelector('#toggleConfirmIcon');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            toggleConfirmIcon.classList.toggle('bi-eye');
            toggleConfirmIcon.classList.toggle('bi-eye-slash');
        });
    </script>
    <!--end::Show Password-->
@endsection
