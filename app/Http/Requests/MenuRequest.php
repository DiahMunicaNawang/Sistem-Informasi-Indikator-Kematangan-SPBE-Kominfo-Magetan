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
            'url' => 'required_if:is_category,false',  // URL hanya diperlukan jika bukan kategori
            'parent_id' => 'required_if:is_category,false',  // parent_id hanya diperlukan jika bukan kategori
            'roles' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Menu wajib diisi!',
            'url.required_if' => 'URL wajib diisi jika menu bukan kategori!',
            'parent_id.required_if' => 'Parent ID wajib diisi jika menu bukan kategori!',
            'roles.required' => 'Role wajib diisi!',
            'roles.array' => 'Role harus berupa array!',
        ];
    }
}
