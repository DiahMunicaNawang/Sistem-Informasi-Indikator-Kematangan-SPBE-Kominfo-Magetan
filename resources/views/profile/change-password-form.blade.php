@extends('layouts.main.index')

@section('page-name', 'Ubah Password')

@section('content')
    <!--begin::Basic info-->
    <div class="mb-5 card mb-xl-10">
        <!--begin::Content-->
        <div id="kt_account_settings_profile_details" class="collapse show">
            <!--begin::Form-->
            <form action="{{ route('profile.change-password', session('user_informations.user_id')) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card card-flush h-md-100">
                    <div class="card-body">
                        <div class="mb-8">
                            <label for="old_password" class="required form-label">Password Lama</label>
                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                                value="{{ old('old_password') }}">
                            @error('old_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label for="new_password" class="required form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                                value="{{ old('new_password') }}">
                            @error('new_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label for="new_password_confirmation" class="required form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation"
                                value="{{ old('new_password_confirmation') }}">
                            @error('new_password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="pt-0 card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->
@endsection
