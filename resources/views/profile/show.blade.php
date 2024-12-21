@extends('layouts.main.index')

@section('page-name', 'Profile Management')

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
            <form id="kt_account_profile_details_form" class="form" action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="mb-6 row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Image input-->
                            <div class="position-relative image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ $user->avatar ? asset("storage/avatars/{$user->avatar}") : asset('assets/media/avatars/blank.png') }}')">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url('{{ $user->avatar ? asset("storage/avatars/{$user->avatar}") : asset('assets/media/avatars/blank.png') }}')">
                                </div>
                                <!--end::Preview existing avatar-->

                                <!--begin::Label-->
                                <label class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />

                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->

                                <!--begin::Cancel-->
                                <span class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                            class="path2"></span></i> </span>
                                <!--end::Cancel-->

                                <!--begin::Remove-->
                                <button type="button" id="remove-avatar-btn"
                                    class="shadow position-absolute btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                                    style="bottom: -12.5px; right: -12.5px;" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                    <input type="hidden" id="avatar-remove-input" name="avatar_remove" value="1">
                                    <!--end::Remove-->
                            </div>
                            @error('avatar')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <!--end::Image input-->

                            <!--begin::Hint-->
                            <div class="form-text">Max file size: 5MB</div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-6 row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Username</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="username" class="form-control form-control-lg form-control-solid"
                                placeholder="Masukkan Username" value="{{ old('username', $user->username) }}"
                                autocomplete="off" />
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-6 row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Email</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="email" name="email" class="form-control form-control-lg form-control-solid"
                                placeholder="Masukkan Email" value="{{ old('email', $user->email) }}" autocomplete="off" />
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <div class="mb-6 row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Password</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <a href="{{ route('profile.change-password-form') }}" class="btn btn-outline btn-outline-primary">Ubah Password</a>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->

                <!--begin::Actions-->
                <div class="py-6 card-footer d-flex justify-content-end px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save
                        Changes</button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

    <script>
        document.getElementById('remove-avatar-btn').addEventListener('click', function() {
            // Menampilkan SweetAlert untuk konfirmasi penghapusan
            Swal.fire({
                title: 'Are you sure?',
                text: "This action will remove your avatar permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#009ef7',
                cancelButtonColor: '#f1416c',
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form penghapusan avatar
                    var form = document.getElementById('kt_account_profile_details_form');
                    form.action =
                        '{{ route('profile.remove-avatar', $user->id) }}'; // Tetapkan rute penghapusan
                    form.method = 'POST'; // Gunakan POST untuk menghapus
                    form.submit(); // Kirim form
                }
            });
        });
    </script>
@endsection
