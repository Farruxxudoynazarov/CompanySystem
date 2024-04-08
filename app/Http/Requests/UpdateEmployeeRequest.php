<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'positon' => 'required',
            'phone' => 'required|numeric',
            'passport_number' => ['required', 'regex:/^[A-Z]{2}[0-9]{7}$/'],
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ];
    }
}
