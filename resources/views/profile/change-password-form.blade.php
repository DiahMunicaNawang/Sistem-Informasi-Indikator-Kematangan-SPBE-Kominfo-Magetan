@extends('layouts.main.index')

@section('page-name', 'Change Password')

@section('content')
    <!--begin::Basic info-->
    <div class="mb-5 card mb-xl-10">
        <!--begin::Card header-->
        <div class="border-0 cursor-pointer card-header" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="m-0 card-title">
                <h3 class="m-0 fw-bold">Profile Details</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->

        <!--begin::Content-->
        <div id="kt_account_settings_profile_details" class="collapse show">
            <!--begin::Form-->
            <form action="{{ route('profile.change-password', session("user_infromations.user_id")) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card card-flush h-md-100">
                    <div class="card-body">
                        <div class="mb-8">
                            <label for="old_password" class="required form-label">Password Lama</label>
                            <input type="text" name="old_password" class="form-control" id="old_password"
                                value="{{ old('old_password') }}">
                            @error('old_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label for="new_password" class="required form-label">Password Baru</label>
                            <input type="text" name="new_password" class="form-control" id="new_password"
                                value="{{ old('new_password') }}">
                            @error('new_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label for="new_password_confirmation" class="required form-label">Konfirmasi Password Baru</label>
                            <input type="text" name="new_password_confirmation" class="form-control" id="new_password_confirmation"
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
