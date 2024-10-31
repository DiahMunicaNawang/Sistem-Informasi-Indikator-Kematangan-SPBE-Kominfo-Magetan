@extends('layouts.auth.index')

@section('content')
    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="form w-100" action="{{ route('authenticating') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="mb-3 text-dark fw-bolder">Masuk</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            {{-- <div class="text-gray-500 fw-semibold fs-6">Selamat Datang!</div> --}}
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group=-->
        <div class="mb-8 fv-row">
            <!--begin::Email-->
            <label for="username">Username</label>
            <input type="text" name="username" class="bg-transparent form-control" autocomplete="off" id="username" required>
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
        <!--begin::Wrapper-->
        <div class="flex-wrap gap-3 mb-8 d-flex flex-stack fs-base fw-semibold">
            <div></div>
            <!--begin::Link-->
            <a href="{{ route('password.email') }}" class="link-primary">Lupa Password ?</a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <div class="mb-10 d-grid">
            <button type="submit" class="btn btn-primary">
                Masuk
            </button>
            <br>
            <a href="" class="link-primary text-center">Registrasi Akun</a>
        </div>
        <!--end::Submit button-->
    </form>


        <!--begin::Show Password-->
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const passwordField = document.querySelector('#password');
            const toggleIcon = document.querySelector('#toggleIcon');

            togglePassword.addEventListener('click', function() {
                // Cek tipe input dan ubah sesuai kebutuhan
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Ubah icon sesuai tipe input
                toggleIcon.classList.toggle('bi-eye');
                toggleIcon.classList.toggle('bi-eye-slash');
            });
        </script>
        <!--end::Show Password-->
@endsection
