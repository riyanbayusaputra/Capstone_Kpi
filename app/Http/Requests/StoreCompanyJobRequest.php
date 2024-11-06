<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyJobRequest extends FormRequest
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
            'salary' => ['required','string'],
            'company_id' => ['required','integer'],
            'category_id' => ['required','integer'],
            'name' => ['required', 'string', 'max:255'],
            'skill_level' => ['required', 'string' , 'max:255'],
            'location' => ['required','string', 'max:255'],
            'type' => ['required','string', 'max:255'],
            'responsibilities.*' => 'required|string|max:255',
            'qualifications.*' => 'required|string|max:255',
            'about'=> ['required', 'string', 'max:65535'],
            'quota' => ['required','integer'],
            'phone_number' => 'nullable|string|max:20',
            'email_contact' => 'nullable|email|max:255',
           
           
            'education' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'verified' => 'required|string|max:255',
            'application_deadline' => 'nullable|date',

        ];
    }
}
