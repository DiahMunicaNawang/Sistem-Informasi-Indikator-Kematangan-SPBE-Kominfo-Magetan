<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $user_id = $this->route('profile');

        return [
            'email' => 'required|string|email|max:255|unique:users,email,' . $user_id,
            'username' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:5048',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email sudah digunakan!',
            'username.required' => 'Username wajib diisi!',
        ];
    }
}
