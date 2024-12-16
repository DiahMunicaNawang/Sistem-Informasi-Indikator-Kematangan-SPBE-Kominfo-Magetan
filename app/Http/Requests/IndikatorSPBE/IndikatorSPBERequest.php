<?php

namespace App\Http\Requests\IndikatorSPBE;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class IndikatorSPBERequest extends FormRequest
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
            'explanation' => 'required|string',
            'rule_information' => 'required|string',
            'criteria' => 'required|string',
            'current_level_radio' => 'required|string',
            'current_level' => 'required|string',
            'target_level_radio' => 'required|string',
            'target_level' => 'required|string',
            'related_documentation' => 'nullable|file|mimes:pdf|max:5048',
            'person_in_charge' => 'required|string',
            'articles' => 'nullable|array',
            'forums' => 'nullable|array'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Nama Indikator SPBE wajib diisi!',
            'explanation.required' => 'Keterangan Indikator SPBE wajib diisi!',
            'rule_information.required' => 'Aturan Indikator SPBE wajib diisi!',
            'criteria.required' => 'Kriteria Indikator SPBE wajib diisi!',
            'current_level_radio.required' => 'Level saat ini wajib diisi!',
            'current_level.required' => 'Level saat ini wajib diisi!',
            'target_level_radio.required' => 'Target level wajib diisi!',
            'target_level.required' => 'Target level wajib diisi!',
            'related_documentation.mimes' => 'Dokumen terkait harus berupa PDF!',
            'related_documentation.max' => 'Ukuran dokumen terkait tidak boleh lebih dari 5MB!',
            'person_in_charge.required' => 'Penanggung Jawab Indikator SPBE wajib diisi!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errorBag = $this->isMethod('post') ? 'store' : 'update';

        throw new ValidationException(
            $validator,
            redirect()->back()
                ->withErrors($validator, $errorBag) // Gunakan bag 'store'
                ->withInput()
        );
    }
}
