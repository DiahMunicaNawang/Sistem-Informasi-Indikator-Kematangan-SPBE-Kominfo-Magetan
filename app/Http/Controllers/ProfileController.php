<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService) {
        $this->profileService = $profileService;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if ($id != session('user_informations.user_id')) {
            return redirect()->route('profile.show', session('user_informations.user_id'))->with('warning', 'Tidak diizinkan mengakses halaman orang lain');
        }

        $data = $this->profileService->showProfile($id);
        return view('profile.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, $id)
    {
        $this->profileService->updateProfile($request->all(), $id);
        return redirect()->route('profile.show', session('user_informations.user_id'))->with('success', 'Profile berhasil diupdate');
    }

    // Remove Avatar
    public function removeAvatar($id) {
        $this->profileService->removeAvatar($id);
        return redirect()->route('profile.show', session('user_informations.user_id'))->with('success', 'Avatar berhasil dihapus');
    }

    public function changePasswordForm() {
        return view('profile.change-password-form');
    }

    public function changePassword(ProfileChangePasswordRequest $request, $id) {
        try {
            $this->profileService->changePassword($request->all(), $id);
            return redirect()->route('profile.show', session('user_informations.user_id'))->with('success', 'Password berhasil diperbarui!');
        } catch (\Exception $e) {
            // Set session error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
