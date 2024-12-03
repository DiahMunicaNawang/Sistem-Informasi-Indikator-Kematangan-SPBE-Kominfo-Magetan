<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            //
            'judul' => 'required|max:255|min:4',
            'ringkasan' => 'required|max:500',
            'konten' => 'required',
            'kategori' => 'required|exists:article_categories,id',
            'image' => 'required|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul artikel wajib diisi.',
            'judul.max' => 'Judul artikel tidak boleh lebih dari 255 karakter.',
            'judul.min' => 'Judul artikel harus lebih banyak lagi',
            'ringkasan.required' => 'Ringkasan artikel wajib diisi.',
            'ringkasan.max' => 'Ringkasan artikel tidak boleh lebih dari 500 karakter.',
            'konten.required' => 'Konten artikel wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'image.required' => 'Gambar thumbnail wajib diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
    }
}
