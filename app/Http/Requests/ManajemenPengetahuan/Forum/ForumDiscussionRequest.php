<?php

namespace App\Http\Requests\ManajemenPengetahuan\Forum;

use Illuminate\Foundation\Http\FormRequest;

class ForumDiscussionRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'forum_category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Nama kategori wajib diisi!',
            'description.required' => 'Deskripsi wajib diisi!',
            'forum_category_id.required' => 'Kategori forum wajib diisi!',
        ];
    }
}
