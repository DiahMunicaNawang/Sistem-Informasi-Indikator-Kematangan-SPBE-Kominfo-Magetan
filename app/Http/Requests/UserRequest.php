<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            // 'email' => 'required|email',
            // 'username' => 'required',
            // 'password' => 'required',
            'role_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            // 'email.required' => 'Email wajib diisi!',
            // 'username.required' => 'Menu wajib diisi!',
            // 'password.array' => 'Menu harus berupa array!',
            'role_id' => 'Role wajib diisi!',
        ];
    }
}
