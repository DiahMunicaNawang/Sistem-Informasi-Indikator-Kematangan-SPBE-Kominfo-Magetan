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
                            <div class="position-relative">
                                <input type="password" name="old_password"
                                    class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                                    value="{{ old('old_password') }}">
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    id="toggleOldPassword">
                                    <i class="bi bi-eye-slash fs-2" id="toggleOldIcon"></i>
                                </span>
                            </div>
                            @error('old_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label for="new_password" class="required form-label">Password Baru</label>
                            <div class="position-relative">
                                <input type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                                    value="{{ old('new_password') }}">
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    id="toggleNewPassword">
                                    <i class="bi bi-eye-slash fs-2" id="toggleNewIcon"></i>
                                </span>
                            </div>
                            @error('new_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label for="new_password_confirmation" class="required form-label">Konfirmasi Password
                                Baru</label>
                            <div class="position-relative">
                                <input type="password" name="new_password_confirmation"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    id="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    id="toggleConfirmPassword">
                                    <i class="bi bi-eye-slash fs-2" id="toggleConfirmIcon"></i>
                                </span>
                            </div>
                            @error('new_password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="pt-0 card-footer">
                        <a href="{{ route('profile.show', session('user_informations.user_id')) }}" type="button" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

    <script>
        // Toggle Old Password
        const toggleOldPassword = document.querySelector('#toggleOldPassword');
        const oldPasswordField = document.querySelector('#old_password');
        const toggleOldIcon = document.querySelector('#toggleOldIcon');

        toggleOldPassword.addEventListener('click', function() {
            const type = oldPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            oldPasswordField.setAttribute('type', type);
            toggleOldIcon.classList.toggle('bi-eye');
            toggleOldIcon.classList.toggle('bi-eye-slash');
        });

        // Toggle New Password
        const toggleNewPassword = document.querySelector('#toggleNewPassword');
        const newPasswordField = document.querySelector('#new_password');
        const toggleNewIcon = document.querySelector('#toggleNewIcon');

        toggleNewPassword.addEventListener('click', function() {
            const type = newPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            newPasswordField.setAttribute('type', type);
            toggleNewIcon.classList.toggle('bi-eye');
            toggleNewIcon.classList.toggle('bi-eye-slash');
        });

        // Toggle Confirm Password
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPasswordField = document.querySelector('#new_password_confirmation');
        const toggleConfirmIcon = document.querySelector('#toggleConfirmIcon');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            toggleConfirmIcon.classList.toggle('bi-eye');
            toggleConfirmIcon.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection
