<?php

namespace App\Http\Requests\Forum;

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
            'title' => 'required|max:255',
            'description' => 'required',
            'forum_category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul forum wajib diisi!',
            'title.max' => 'Judul forum maksimal 255 karakter!',
            'description.required' => 'Deskripsi wajib diisi!',
            'forum_category_id.required' => 'Kategori forum wajib diisi!',
        ];
    }
}
