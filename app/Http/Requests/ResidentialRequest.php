<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentialRequest extends FormRequest
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
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'block_id'    => 'required|exists:blocks,id',
        ];
    }

    public function messages(): array
    {
        return [
            'division_id.required' => 'Please select your division.',
            'district_id.required' => 'Please select your district.',
            'block_id.required'    => 'Please select your block.',
        ];
    }
}
