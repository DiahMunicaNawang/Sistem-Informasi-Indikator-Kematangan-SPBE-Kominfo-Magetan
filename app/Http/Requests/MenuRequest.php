<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name' => 'required',
            'url' => 'required',
            'roles' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Menu wajib diisi!',
            'url.required' => 'URL wajib diisi!',
            'roles.required' => 'Role wajib diisi!',
            'roles.array' => 'Role harus berupa array!',
        ];
    }
}
