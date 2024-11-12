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
            'name' => 'required|string|max:255',
            'type' => 'required|in:category,menu,dropdown',
            'url' => 'required_if:type,menu|nullable|string',
            'category_id' => [
                'nullable',
                'exists:menus,id',
                'forbidden_if:type,category'
            ],
            'dropdown_id' => [
                'nullable',
                'exists:menus,id',
                'forbidden_if:type,category,dropdown'
            ],
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama menu wajib diisi!',
            'name.string' => 'Nama menu harus berupa text!',
            'name.max' => 'Nama menu maksimal 255 karakter!',

            'type.required' => 'Tipe menu wajib diisi!',
            'type.in' => 'Tipe menu harus berupa category, menu, atau dropdown!',

            'url.required_if' => 'URL wajib diisi untuk tipe menu!',
            'url.string' => 'URL harus berupa text!',

            'category_id.exists' => 'Kategori yang dipilih tidak valid!',
            'category_id.forbidden_if' => 'Kategori tidak boleh diisi untuk tipe category!',

            'dropdown_id.exists' => 'Dropdown yang dipilih tidak valid!',
            'dropdown_id.forbidden_if' => 'Dropdown tidak boleh diisi untuk tipe category atau dropdown!',

            'roles.required' => 'Role wajib diisi!',
            'roles.array' => 'Role harus berupa array!',
            'roles.*.exists' => 'Role yang dipilih tidak valid!'
        ];
    }

    protected function prepareForValidation()
    {
        // Jika type adalah category, set beberapa field menjadi null
        if ($this->type === 'category') {
            $this->merge([
                'url' => null,
                'category_id' => null,
                'dropdown_id' => null,
            ]);
        }

        // Jika type adalah dropdown, set beberapa field menjadi null
        if ($this->type === 'dropdown') {
            $this->merge([
                'url' => null,
                'dropdown_id' => null,
            ]);
        }
    }
}
