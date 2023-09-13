<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DbRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
			'firstname' => 'required',
			'dob'       => 'required'
        ];
    }

	public function messages(): array
	{
		return [
			'firstname.required' => 'Введите имя',
			'dob.required'       => 'Введите дату'
		];
	}
}
