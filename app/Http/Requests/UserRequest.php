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
        $rules = [
            'email' => 'required|email',
            'username' => 'required',
            'role_id' => 'required',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi!',
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.array' => 'Menu harus berupa array!',
            'role_id' => 'Role wajib diisi!',
        ];
    }
}
