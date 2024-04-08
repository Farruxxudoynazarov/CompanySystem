<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'positon' => 'required|max:255',
            'phone' => 'required|numeric',
            'passport_number' => ['required', 'regex:/^[A-Z]{2}[0-9]{7}$/'],
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ];
    }
}
