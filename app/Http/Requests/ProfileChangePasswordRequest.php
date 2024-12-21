<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed:new_password_confirmation',
            'new_password_confirmation' => 'required|string|min:8|confirmed:new_password',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Password lama wajib diisi!',
            'new_password.required' => 'Password baru wajib diisi!',
            'new_password_confirmation.required' => 'Konfirmasi password baru wajib diisi!',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok!',
            'new_password_confirmation.confirmed' => 'Konfirmasi password baru tidak cocok!',
            'old_password.min' => 'Password lama harus memiliki minimal 8 karakter!',
            'new_password.min' => 'Password baru harus memiliki minimal 8 karakter!',
            'new_password_confirmation.min' => 'Konfirmasi password baru harus memiliki minimal 8 karakter!',

        ];
    }
}
