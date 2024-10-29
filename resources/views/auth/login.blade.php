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
            <input type="text" placeholder="Username" name="username" class="bg-transparent form-control" autocomplete="off" id="username" required>
            <!--end::Email-->
        </div>
        <!--end::Input group=-->
        <div class="mb-3 fv-row">
            <!--begin::Password-->
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" class="bg-transparent form-control" autocomplete="off" id="password" required>

                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </button>
            </div>
            <!--end::Password-->
        </div>
        <!--end::Input group=-->
        <!--begin::Wrapper-->
        <div class="flex-wrap gap-3 mb-8 d-flex flex-stack fs-base fw-semibold">
            <div></div>
            <!--begin::Link-->
            <a href="/password/reset" class="link-primary">Lupa Password ?</a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <div class="mb-10 d-grid">
            <button type="submit" class="btn btn-primary">
                Masuk
            </button>
        </div>
        <!--end::Submit button-->
    </form>
@endsection
