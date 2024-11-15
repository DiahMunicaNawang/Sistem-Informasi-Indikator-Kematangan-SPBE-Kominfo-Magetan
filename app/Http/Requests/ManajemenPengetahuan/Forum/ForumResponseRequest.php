<?php

namespace App\Http\Requests\ManajemenPengetahuan\Forum;

use Illuminate\Foundation\Http\FormRequest;

class ForumResponseRequest extends FormRequest
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
            'content' => 'required|max:1000',
            'forum_discussion_id' => 'exists:forum_discussions,id',
            'parent_id' => 'nullable|exists:forum_responses,id'
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Konten komentar wajib diisi!',
            'content.max' => 'Konten komentar maksimal 1000 karakter!',
            'forum_discussion_id.exists' => 'Diskusi forum tidak ditemukan!',
            'parent_id.exists' => 'Komentar parent tidak ditemukan!'
        ];
    }
}
