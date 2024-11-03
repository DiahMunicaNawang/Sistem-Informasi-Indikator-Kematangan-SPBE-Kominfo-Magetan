<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'menus' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama role wajib diisi!',
            'menus.required' => 'Menu wajib diisi!',
            'menus.array' => 'Menu harus berupa array!',
        ];
    }
}
