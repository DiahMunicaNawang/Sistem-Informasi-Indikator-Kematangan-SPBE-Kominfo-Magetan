<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordService
{
    public function sendResetLink($email)
    {
        return Password::sendResetLink(['email' => $email]);
    }

    public function resetPassword($credentials)
    {
        return Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
    }

    public function isResetSuccessful($status)
    {
        return $status === Password::PASSWORD_RESET;
    }

    public function isLinkSent($status)
    {
        return $status === Password::RESET_LINK_SENT;
    }
}