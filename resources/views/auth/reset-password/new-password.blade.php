@extends('layouts.auth.index')

@section('content')

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form class="form w-100" action="{{ route('password.resetEmail') }}" method="POST">
    @csrf
    <!--begin::Heading-->
    <div class="mb-10 text-center">
        <!--begin::Title-->
        <h1 class="mb-3 text-dark fw-bolder">Lupa Password ?</h1>
        <!--end::Title-->
        <!--begin::Link-->
        <div class="text-gray-500 fw-semibold fs-6">Masukkan email Anda untuk mereset password.</div>
        <!--end::Link-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group=-->
    <div class="mb-8 fv-row">
         <!--begin::Email-->
         <label for="email">Email</label>
         <input type="email" name="email" autocomplete="off" class="bg-transparent form-control" id="email" required/>
         <!--end::Email-->
    </div>
    <!--begin::Actions-->
    <div class="flex-wrap d-flex justify-content-center pb-lg-0">
        <button type="submit" class="btn btn-primary me-4">
            Reset
        </button>
        <a href="{{ route("login") }}" class="btn btn-light">Cancel</a>
    </div>
    <!--end::Actions-->
</form>

@endsection